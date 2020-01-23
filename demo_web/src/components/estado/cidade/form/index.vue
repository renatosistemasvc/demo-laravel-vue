<template>
    
    <div class="main">
        <c-panel>
            <form-cidade :paramId="$route.params.id" v-on:onSubmitCidade="onSubmitCidade"></form-cidade>
        </c-panel>
    </div>
    
</template>
<script>

import formCidade from "./form"

export default {
    methods:{

        onSubmitCidade(){

            this.$router.push('/admin/endereco/4');   
        }
    },
    components:{ formCidade }
}
</script>
