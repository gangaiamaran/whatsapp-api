<template>
    <div class="flex h-screen bg-gray-100 dark:bg-darkBackground">
        <!-- Sidebar -->
        <Sidebar :chatrooms="chatrooms" @select-chatroom="selectChatroom" />

        <!-- Chat Area -->
        <div v-if="selectedChatroom" class="flex-1 flex flex-col dark:bg-darkAccent">
            <ChatArea :chatroom="selectedChatroom" />
        </div>
        <div v-else class="flex-1 flex items-center justify-center dark:bg-darkBackground text-gray-400 dark:text-darkText">
            <p>Select a chat to start messaging</p>
        </div>

        <!-- Dark Mode Toggle Button -->
        <button
            @click="toggleDarkMode"
            class="fixed bottom-4 right-4 p-2 bg-gray-800 dark:bg-gray-200 rounded-full shadow-lg text-white dark:text-black"
        >
            Toggle Dark Mode
        </button>
    </div>
</template>

<script>
import Sidebar from "./../Components/Sidebar.vue";
import ChatArea from "./../Components/ChatArea.vue";

export default {
    components: { Sidebar, ChatArea },
    data() {
        return {
            chatrooms: [
                { id: 1, name: "Alice", lastMessage: "Hello!" },
                { id: 2, name: "Bob", lastMessage: "Goodbye!" },
            ],
            selectedChatroom: null,
            isDarkMode: false, // Dark mode toggle state
        };
    },
    methods: {
        selectChatroom(chatroom) {
            this.selectedChatroom = chatroom;
        },
        toggleDarkMode() {
            this.isDarkMode = !this.isDarkMode;
            document.documentElement.classList.toggle('dark', this.isDarkMode);
        },
    },
};
</script>

<style scoped>
/* Dark mode-specific styling */
body.dark {
    background-color: #121212;
    color: #e4e4e4;
}
</style>
