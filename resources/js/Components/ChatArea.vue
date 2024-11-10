<!-- resources/js/Components/ChatArea.vue -->
<template>
    <div class="flex flex-col h-full">
        <!-- Chat Header -->
        <div class="p-4 bg-green-500 text-white flex items-center">
            <img :src="chatroom.avatar" alt="Avatar" class="w-10 h-10 rounded-full mr-4" />
            <h2 class="text-lg font-semibold">{{ chatroom.name }}</h2>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 p-4 overflow-y-auto bg-gray-50">
            <div
                v-for="message in messages"
                :key="message.id"
                :class="{
          'self-end bg-green-100 text-gray-800': message.user === currentUser,
          'self-start bg-white text-gray-600': message.user !== currentUser
        }"
                class="p-3 mb-2 rounded-lg shadow-sm max-w-xs"
            >
                <p class="text-sm">{{ message.content }}</p>
            </div>
        </div>

        <!-- Message Input -->
        <div class="p-4 bg-gray-100 flex items-center">
            <input
                type="text"
                v-model="newMessage"
                placeholder="Type a message..."
                class="flex-1 p-2 border rounded-full bg-white focus:outline-none"
                @keydown.enter="sendMessage"
            />
            <button @click="sendMessage" class="ml-2 p-2 bg-green-500 text-white rounded-full hover:bg-green-600">➤</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["chatroom"],
    data() {
        return {
            messages: [
                { id: 1, content: "Hello!", user: "Alice" },
                { id: 2, content: "Hi there!", user: "You" },
            ],
            newMessage: "",
            currentUser: "You",
        };
    },
    methods: {
        sendMessage() {
            if (this.newMessage.trim()) {
                this.messages.push({ content: this.newMessage, user: this.currentUser });
                this.newMessage = "";
            }
        },
    },
};
</script>
