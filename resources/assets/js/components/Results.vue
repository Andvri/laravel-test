<template>
    <section>
        <b-tabs v-model="activeTab">
            <b-tab-item label="Guardados"
            :disabled='save.length === 0'
            >

                <t-save :data="save"></t-save>
            </b-tab-item>

            <b-tab-item label="Duplicados"
            :disabled='dupli.length === 0'
            >
               <t-save :data="dupli"></t-save>
            </b-tab-item>
            <b-tab-item label="Errores"
            :disabled='err.length === 0' >
              <t-error :data="err"></t-error>
            </b-tab-item>
        </b-tabs>
    </section>
</template>

<script>
 import Terror from './Terror.vue'
 import Tduplicate from './Tduplicate.vue'
 import Tsave from './Tsave.vue'
 
 export default {
        props: ['save','err','dupli'],
        data() {
            return {
                activeTab: 0
            }
        },
        components: {
          't-error': Terror,
          't-save': Tsave,
          't-duplicate': Tduplicate
        }
    }
</script>
