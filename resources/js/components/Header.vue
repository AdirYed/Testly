<template>
    <theory-nav-bar>
        <template slot="left-bar">
            <theory-bar to="home">
                <fa-icon icon="home" />
                עמוד הבית
            </theory-bar>
            <theory-bar to="tests" :toParams="{ drivingLicenseType: 'a3' }">
                <fa-icon icon="newspaper" />
                מבחנים
            </theory-bar>
        </template>

        <template slot="right-bar">
            <theory-bar to="#">
                <fa-icon icon="sign-in-alt" />
                הירשם / התחבר
            </theory-bar>
            <theory-bar to="##">
                <fa-icon icon="globe" />
                שפה
            </theory-bar>
        </template>
    </theory-nav-bar>
</template>

<script>
    export default {
        name: 'nav-header',
    }
</script>
