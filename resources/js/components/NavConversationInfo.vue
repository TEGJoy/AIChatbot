<script setup lang="ts">
import { computed } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import { chat } from '@/routes';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { useInitials } from '@/composables/useInitials';
import type { ConversationInformation } from '@/types';
import { Link } from '@inertiajs/vue3';


type Props = {
    conversationInfo: ConversationInformation;
};
const props = withDefaults(defineProps<Props>(), {});
const url = "http://127.0.0.1:8000/chat/";
</script>

<template>
     <SidebarGroup class="px-2 py-0">
        <SidebarMenu>
            <SidebarMenuItem v-for="conversation in props.conversationInfo" :key="conversation.conversation_id">
                <SidebarMenuButton
                    as-child
                >
                <Link :href="`${url}${conversation.conversation_id}`">
                    <span>{{ conversation.conversation_id }}</span>
                </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>

</template>
