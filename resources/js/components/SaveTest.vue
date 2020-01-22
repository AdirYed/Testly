<template>
    <div>
        על מנת לשמור את המבחן, נא
        <button @click="register()">
            הירשם
        </button>
        /
        <button @click="login()">
            התחבר</button
        >.
    </div>
</template>

<script>
import router from ".././routes";

export default {
    name: "save-test",

    methods: {
        register() {
            this.$emit("close-toast");
            router.push({ name: "register" });
        },

        login() {
            this.$emit("close-toast");
            router.push({ name: "login" });
        }
    }
};
</script>
