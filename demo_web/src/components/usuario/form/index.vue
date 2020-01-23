<template>
    
    <div class="main">
        <c-panel>
            <form-usuario :paramId="$route.params.id" v-on:onSubmitUsuario="onSubmitUsuario"></form-usuario>
        </c-panel>
    </div>
    
</template>
<script>

import formUsuario from "./form"

export default {
    methods:{

        onSubmitUsuario(){

            this.$router.push('/admin/usuario');  
        }
    },
    components:{ formUsuario }
}
</script>
