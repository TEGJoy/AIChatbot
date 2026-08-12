<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { ChevronsUpDown } from '@lucide/vue';
import NavConversationInfo from './NavConversationInfo.vue';
import { computed } from 'vue';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import {
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    useSidebar,
} from '@/components/ui/sidebar';


const page = usePage();
const conversationInfo = computed(() => page.props.auth.conversationInfo);
const { isMobile, state } = useSidebar();
</script>

<template>
    <SidebarMenu>
        <SidebarMenuItem>
            <NavConversationInfo :conversationInfo="conversationInfo" />
        </SidebarMenuItem>
    </SidebarMenu>
</template>
