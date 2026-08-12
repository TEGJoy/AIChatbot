<script setup lang="ts">

import { Head, Link } from '@inertiajs/vue3';
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { chat, login } from '@/routes';
import { register } from '@/routes';

</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
        <Card>
            <CardHeader>
                <CardTitle>AI Chatbot project</CardTitle>
            </CardHeader>
            <CardContent>
                <p>Welkom op de landingspagina van de AI Chatbot</p>
                <br>
                <template v-if="$page.props.auth.user">
                <p>Je bent al ingelogd, druk op de knop om naar de AI chat te gaan</p>
                <br>
                <Link
                    :href="chat()"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Chat
                </Link>
            </template>
                <template v-else>
                    <Link
                        :href="login()"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="register()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </CardContent>
        </Card>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
