<template>
    <div :class="{
        'side-bar__item d-flex align-items-center p-2': true,
        'active': selected.indexOf(user.id) != -1
    }" @click="$emit('select', user)">
        <div class="avatar">
            <img width="45" height="45" :src="user.avatar" class="img-fluid header-avatar mr-2 border" alt="" />
        </div>
        <div class="header-box flex-fill side-bar__item-content">
            <p class="header-name mb-0 d-inline-block text-truncate" v-text="user.name"></p>
            <span class="mb-0 text-secondary d-inline-block text-truncate" v-text="user.email"></span>
        </div>
    </div>
</template>
<script>
export default {
    props: ['user', 'selected']
}
</script>