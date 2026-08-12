<?php

namespace App\Http\Controllers;

use App\Ai\Agents\ChatAgent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Models\Agent_conversation_message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Ai\Exceptions\AiException;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Models\Conversation;
use Throwable;

class ChatBotController extends Controller
{

    public function show(string $conversation_id){
        $conversation = Agent_conversation_message::where('conversation_id', $conversation_id)->get();
        return Inertia::render('chat/Chat', ['conversation_history' => $conversation]);
    }
    public function all(){
        $conversationIds = Agent_conversation_message::select('conversation_id')->distinct()->get();
        return $conversationIds;
    }

    /**
     * Converse with the chatbot
     */
    public function conversation(ConversationRequest $request)
    {
        $user = User::find(1);
        $validated = $request->validated();
        $response = "";
        $conversationId = $validated['conversation_id'] ?? "";
        if(!$conversationId){
            try{
                $response = (new ChatAgent)->forUser($user)->prompt($validated["input"],
                provider: Lab::Anthropic
                );
            }

            catch(AiException $e){
                $previous = $e->getPrevious();
                $response = $previous->response;
                Log::error($response->effectiveUri());
                Log::error($response->body());
                throw $e;
            }
            catch(Throwable $e){
                throw $e;
            }
            $conversationId = $response->conversationId;
            $message = $response->text;
            $jsonArray = json_decode($response, true);
            $jsonArray['conversation_id'] = $conversationId;
            $jsonArray['message'] = $message;
            $response = json_encode($jsonArray);
        } else {
            try{
                $response = (new ChatAgent)
                ->continue($conversationId, as: $user)->prompt($validated["input"],
                provider: Lab::Anthropic
                );
            }
            catch(AiException $e){
                $previous = $e->getPrevious();
                $response = $previous->response;
                Log::error($response->effectiveUri());
                Log::error($response->body());
                throw $e;
            }
            catch(Throwable $e){
                throw $e;
            }
            $message = $response->text;
            $jsonArray = json_decode($response, true);
            $jsonArray['conversation_id'] = $conversationId;
            $jsonArray['message'] = $message;
            $response = json_encode($jsonArray);
        }

        return $response;
    }
}
