<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage" style="height: 70px !important; border-radius: 10px">
        
        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage" style="height: 70px !important; width: 100px; border-radius: 10px">
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user','room_id'],
        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                    room_id:this.room_id
                    
                });

                this.newMessage = ''
            }
        }    
    }
</script>
