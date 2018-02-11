<template>
    <section>
        <div class="container">
            <b-field grouped group-multiline>
            <div class="control">
                <b-taglist attached>
                    <b-tag type="is-dark">Guardados</b-tag>
                    <b-tag type="is-info">{{save.length}}</b-tag>
                </b-taglist>
            </div>

            <div class="control">
                <b-taglist attached>
                    <b-tag type="is-dark">Duplicados</b-tag>
                    <b-tag type="is-warning">{{dupli.length}}</b-tag>
                </b-taglist>
            </div>

            <div class="control">
                <b-taglist attached>
                    <b-tag type="is-dark">Errores</b-tag>
                    <b-tag type="is-danger">{{err.length}}</b-tag>
                </b-taglist>
            </div>
        </b-field>
        </div>
        <b-tabs v-model="activeTab">
            <template v-if="save.length > 0">
                <b-tab-item label="Guardados"
                :disabled='save.length === 0'
                >
                    <t-save :data="save"></t-save>
                </b-tab-item>
            </template>

            <template v-if="dupli.length > 0">
            <b-tab-item label="Duplicados"
            :disabled='dupli.length === 0'
            >
               <t-save :data="dupli"></t-save>
            </b-tab-item>
            </template>
            <template v-if="err.length > 0">
            
            <b-tab-item label="Errores"
            :disabled='err.length === 0' >
              <t-error :data="err"></t-error>
            </b-tab-item>
            </template>
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
