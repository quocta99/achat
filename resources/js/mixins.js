import {mapGetters} from 'vuex'

export default {
    computed: {
        ...mapGetters({
            currentUser: 'getAuth',
            userOnline: 'getUserOnline'
        })
    }
}