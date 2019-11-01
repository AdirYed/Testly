<template>
    <theory-nav-bar>
        <template slot="left-bar">
            <theory-bar to="home">עמוד הבית</theory-bar>
            <theory-bar to="tests">מבחנים</theory-bar>
        </template>

        <template slot="right-bar">
            <theory-bar to="#">הירשם / התחבר</theory-bar>
            <theory-bar to="##">שפה</theory-bar>
        </template>
    </theory-nav-bar>
</template>

<script>
    export default {
        name: 'full-nav',
    }
</script>
