import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        auth: '',
        conversations: [],
        conversationDetail: ''
    },
    getters: {
        getAuth: state => {
            return state.auth
        },
        getConversations: state => {
            return state.conversations
        },
        getConversationDetail: state => {
            return state.conversationDetail
        }
    },
    mutations: {
        setAuth(state, payload) {
            state.auth = payload
        },
        setConversations(state, payload) {
            state.conversations = [...state.conversations, ...payload]
        },
        setConversationDetail(state, payload) {
            state.conversationDetail = payload
        },
    }
})

export default store