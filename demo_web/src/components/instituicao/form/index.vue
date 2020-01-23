<template>
    
    <div class="main">
        <!-- <c-panel> -->
            <form-base :paramId="$route.params.id" v-on:onSubmitInstituicao="onSubmitInstituicao"></form-base>
        <!-- </c-panel> -->
    </div>
    
</template>
<script>

import formBase from "./form"

export default {
    methods:{

        onSubmitInstituicao(){

            this.$router.push('/admin/instituicao');  
        }
    },
    components:{ formBase }
}
</script>
