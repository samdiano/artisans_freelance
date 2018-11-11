<template>
    <ul class="chat messages" v-chat-scroll>
        <li class="left clearfix message"  v-for="message in messages">
                                    <span class="chat-img pull-left">
                                        <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle"/>
                                    </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">{{ message.user.name }}</strong>
                    <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-time"></span>12 mins ago
                    </small>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>


</template>

<script>
    export default {
        props: ['messages']
    };
</script>