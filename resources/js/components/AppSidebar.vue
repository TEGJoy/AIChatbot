<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { BookOpen, FolderGit2, LayoutGrid } from '@lucide/vue';
import NavConversation from './NavConversation.vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { chat } from '@/routes';
import type { NavItem } from '@/types';


const mainNavItems: NavItem[] = [
    {
        title: 'nieuwe chat',
        href: chat(),
        icon: LayoutGrid,
    },
];


</script>

<template>
    <Sidebar collapsible="icon" variant="inset">

        <SidebarContent>
            <NavMain :items="mainNavItems" />
            <NavConversation />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
