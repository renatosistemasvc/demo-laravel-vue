<template>
    
    <div class="main">
        <c-panel>
            <form-cep :paramId="$route.params.id" v-on:onSubmitCep="onSubmitCep"></form-cep>
        </c-panel>
    </div>
    
</template>
<script>

import formCep from "./form"

export default {
    methods:{

        onSubmitCep(){

            this.$router.push('/admin/endereco/4');  
        }
    },
    components:{ formCep }
}
</script>
