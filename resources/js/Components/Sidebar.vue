<template>
    <div class="w-1/3 bg-gray-100 dark:bg-darkAccent h-full flex flex-col border-r dark:border-gray-700">
        <!-- Header -->
        <div class="p-4 bg-gray-300 dark:bg-gray-900 flex items-center justify-between text-white">
            <h2 class="text-lg font-bold">Chats</h2>
        </div>

        <!-- Search Bar -->
        <div class="p-4">
            <input
                type="text"
                placeholder="Search or start new chat"
                v-model="searchQuery"
                class="w-full p-2 rounded-md border dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200"
            />
        </div>

        <!-- Chatroom List -->
        <div class="overflow-y-auto flex-1">
            <div
                v-for="chatroom in filteredChatrooms"
                :key="chatroom.id"
                @click="selectChatroom(chatroom)"
                class="flex items-center p-4 cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-150"
            >
                <div class="flex-1">
                    <h3 class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ chatroom.name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ chatroom.lastMessage }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
