<template>
    <div class="header border-bottom p-2 px-3">
        <div class="d-flex align-items-center mb-4">
            <img width="45" height="45" :src="currentUser.avatar" class="img-fluid header-avatar mr-2 border" alt="" />
            <div class="header-box flex-fill">
                <p class="header-name mb-0" v-text="currentUser.name"></p>
            </div>
            <slot />
        </div>
        <div class="d-flex align-items-center">
            <div class="input-group search">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fal fa-search text-secondary"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Search chat" />
            </div>
            <button class="btn btn-primary ml-2 new-chat" data-toggle="modal" data-target="#createNewChat">
                <i class="fas fa-plus-circle"></i>
            </button>
            <modal-create-component />
        </div>
    </div>
</template>