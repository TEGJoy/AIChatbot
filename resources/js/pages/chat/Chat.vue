<script setup lang="ts">
import { Head, useHttp } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { ref } from 'vue';
import {
  Card,
} from '@/components/ui/card'
import { Bubble, BubbleContent } from "@/components/ui/bubble"
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Message, MessageAvatar, MessageContent, MessageFooter } from "@/components/ui/message"
import AppLayout from '@/layouts/AppLayout.vue';
import { chat, dashboard } from '@/routes';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'chat',
        href: '/chat',
    },
];

const props = defineProps({
    conversation_history: {
        type: Object,
        required: false
    }
});

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Chat',
                href: chat(),
            },
        ],
    },
});

const messages = ref([]);
const conversationId = ref("");
const conversation = useHttp({
    input: "",
    conversation_id: conversationId.value
})

if(props.conversation_history){
    for(let i = 0; i < props.conversation_history.length; i++){

        if(props.conversation_history[i].role == "user"){
            messages.value.push({text: props.conversation_history[i].content, index: 0, isUser: true});
        } else {
            messages.value.push({text: props.conversation_history[i].content, index: 0, isUser: false});
        }
    }

    conversation.conversation_id = props.conversation_history[0].conversation_id
}

function sendMessage(){
    messages.value.push({text: conversation.input, index: 0, isUser: true});
    conversation.post('http://127.0.0.1:8000/api/conversation', {
        onSuccess: (response) => {
            messages.value.push({text: response.message, index: 1, isUser: false});
            if(!conversationId.value){
                setConversationID(response.conversation_id);
            }
        },
    })
}
function setConversationID(ID: string){
    conversation.conversation_id = ID;
}
</script>

<template>
    <Head title="Chat" />

    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
    <AppLayout :breadcrumbs="breadcrumbs">
        <Card>
        <template v-for="message in messages" :key="message.index">
            <Message align="end">
                <MessageContent>
                    <Bubble v-if="message.isUser">
                        <BubbleContent>{{ message.text }}</BubbleContent>
                    </Bubble>
                    <Bubble v-else variant="muted">
                        <BubbleContent>{{ message.text }}</BubbleContent>
                    </Bubble>
                </MessageContent>
            </Message>
        </template>
        <Input type="input" placeholder="Ask a question" v-model="conversation.input" />
        <Input hidden v-model="conversation.conversation_id" />
        <Button type="submit" @click="sendMessage">
        Send message
        </Button>
    </Card>
    </AppLayout>
  </div>
</template>
