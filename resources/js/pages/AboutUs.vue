<template>
    <div
        class="tw-container tw-mx-auto tw-pt-8 md:tw-pt-10 tw-px-6 md:tw-px-10"
    >
        <div class="tw-text-2xl md:tw-text-3xl tw-font-semibold tw-text-center">
            אודות
        </div>

        <div class="tw-w-full tw-max-w-xs tw-mx-auto"></div>
    </div>
</template>

<script>
export default {
    name: "login",

    data() {
        return {
            auth: {
                email: "matan.yed@gmail.com",
                password: "secret"
            },

            isLoading: false,

            errors: {},

            verification: {
                isVerified: false,
                token: null
            }
        };
    },

    methods: {
        login() {
            this.isLoading = true;

            this.$store
                .dispatch("login", this.auth)
                .then(() => {
                    this.isLoading = false;
                    this.$router.push({ name: "home" });
                })
                .catch(err => {
                    if (
                        err.response.status === 422 &&
                        err.response.data.error === "verification"
                    ) {
                        this.verification.isVerified = true;
                        this.verification.token = err.response.data.token;
                    }

                    if (
                        err.response.status === 422 &&
                        err.response.data.errors
                    ) {
                        this.errors = err.response.data.errors;
                    }
                    this.isLoading = false;
                });
        },

        deleteError(property) {
            this.errors[property] = null;
        },

        resendVerification() {
            this.$axios
                .post(
                    "/resend-verification",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${this.verification.token}`
                        }
                    }
                )
                .then(() => {
                    alert("אימייל נשלח");
                })
                .catch(err => {
                    if (err.response.data.verified) {
                        alert("משתמש אומת כבר");
                    }
                });
        }
    },

    created() {
        if (this.$route.query.verified === "1") {
            this.$router.replace("login");
            alert("משתמש זה אומת");
        }
    }
};
</script>
