<template>
    
    <div class="main">
        <c-panel>
            <form-logradouro :paramId="$route.params.id" v-on:onSubmitLogradouro="onSubmitLogradouro"></form-logradouro>
        </c-panel>
    </div>
    
</template>
<script>

import formLogradouro from "./form"

export default {
    methods:{

        onSubmitLogradouro(){

            this.$router.push('/admin/endereco/0');  
        }
    },
    components:{ formLogradouro }
}
</script>
