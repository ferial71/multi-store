<template>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="relative bg-white" >
                <div class="max-w-7xl mx-auto overflow-hidden" style="min-height: 100vh;">
                    <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                        <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                            <polygon points="50,0 100,0 50,100 0,100" />
                        </svg>

                        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                            <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
                                <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                                    <div class="flex items-center justify-between w-full md:w-auto">
                                        <a href="#">
                                            <span class="sr-only">Workflow</span>
                                            <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg">
                                        </a>
                                        <div class="-mr-2 flex items-center md:hidden">
                                            <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" id="main-menu" aria-haspopup="true">
                                                <span class="sr-only">Open main menu</span>
                                                <!-- Heroicon name: menu -->
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="canLogin" class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                                    <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Product</a>

                                    <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Features</a>

                                    <a href="#" class="font-medium text-gray-500 hover:text-gray-900">Marketplace</a>
                                        <inertia-link v-if="$page.props.user" href="/dashboard" class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Dashboard
                                        </inertia-link>

                                        <template v-else>
                                            <inertia-link :href="route('login')" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Login
                                            </inertia-link>

                                            <inertia-link v-if="canRegister" :href="route('register')" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Register
                                            </inertia-link>
                                        </template>
                                </div>
                            </nav>
                        </div>

                        <!--
                          Mobile menu, show/hide based on menu open state.

                          Entering: "duration-150 ease-out"
                            From: "opacity-0 scale-95"
                            To: "opacity-100 scale-100"
                          Leaving: "duration-100 ease-in"
                            From: "opacity-100 scale-100"
                            To: "opacity-0 scale-95"
                        -->
                        <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                            <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                                <div class="px-5 pt-4 flex items-center justify-between">
                                    <div>
                                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">
                                    </div>
                                    <div class="-mr-2">
                                        <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                            <span class="sr-only">Close main menu</span>
                                            <!-- Heroicon name: x -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div role="menu" aria-orientation="vertical" aria-labelledby="main-menu">
                                    <div class="px-2 pt-2 pb-3 space-y-1" role="none">
                                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" role="menuitem">Product</a>

                                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" role="menuitem">Features</a>

                                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" role="menuitem">Marketplace</a>

                                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" role="menuitem">Company</a>

                                    </div>
                                    <div role="none">
                                        <inertia-link v-if="$page.props.user" href="/dashboard" class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100" role="menuitem">
                                            Dashboard
                                        </inertia-link>

                                        <template v-else>
                                            <inertia-link :href="route('login')" class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100" role="menuitem">
                                                Login
                                            </inertia-link>

                                            <inertia-link v-if="canRegister" :href="route('register')" class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100">
                                                Register
                                            </inertia-link>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                            <div class="sm:text-center lg:text-left">
                                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                                    <span class="block xl:inline">Data to enrich your</span>
                                    <span class="block text-indigo-600 xl:inline">online business</span>
                                </h1>
                                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                    Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                            Get started
                                        </a>
                                    </div>
                                    <div class="mt-3 sm:mt-0 sm:ml-3">
                                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                                            Live demo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>

                </div>
<!--                <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 overflow-hidden" style="min-height: 100vh;">-->
<!--                    <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full object-scale-down" src="https://images.unsplash.com/photo-1556741533-974f8e62a92d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="">-->
<!--                </div>-->
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="py-12 bg-white" style="min-height: 100vh; z-index: 100">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="lg:text-center">
                            <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Transactions</h2>
                            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                A better way to send money
                            </p>
                            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                                Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam voluptatum cupiditate veritatis in accusamus quisquam.
                            </p>
                        </div>

                        <div class="mt-10">
                            <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                            <!-- Heroicon name: globe-alt -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Competitive exchange rates
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                            <!-- Heroicon name: scale -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            No hidden fees
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                            <!-- Heroicon name: lightning-bolt -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Transfers are instant
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.
                                        </dd>
                                    </div>
                                </div>

                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                            <!-- Heroicon name: annotation -->
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <dt class="text-lg leading-6 font-medium text-gray-900">
                                            Mobile notifications
                                        </dt>
                                        <dd class="mt-2 text-base text-gray-500">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.
                                        </dd>
                                    </div>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

            <Footer/>
            </div>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    import Footer from '../components/Footer';
    export default {
        components: {
            Footer,
        },
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>
