<template>
    <section>
        <b-field grouped group-multiline>
            <b-select v-model="defaultSortDirection">
                <option value="asc">Default sort direction: ASC</option>
                <option value="desc">Default sort direction: DESC</option>
            </b-select>
            <b-select v-model="perPage" :disabled="!isPaginated">
                <option value="5">5 por pagina</option>
                <option value="10">10 por pagina</option>
                <option value="15">15 por pagina</option>
                <option value="20">20 por pagina</option>
            </b-select>
        </b-field>

        <b-table
            :data="data"
            :paginated="isPaginated"
            :per-page="perPage"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :default-sort-direction="defaultSortDirection"
            default-sort="id"
            narrowed
            bordered
            >

            <template slot-scope="props">
                <b-table-column field="id" label="ID" width="40" sortable numeric>
                    {{ props.row.id }}
                </b-table-column>

                <b-table-column field="company.name" label="Compañia" sortable>
                    {{ props.row.company }}
                </b-table-column>
                <b-table-column field="names" label="Nombres" sortable>
                    {{ props.row.names }}
                </b-table-column>

                <b-table-column field="paternal_surname" label="Apellido Paterno" sortable>
                    {{ props.row.paternal_surname }}
                </b-table-column>

                <b-table-column field="maternal_surname" label="Apellido Materno" sortable>
                    {{ props.row.maternal_surname }}
                </b-table-column>


                <b-table-column label="Genero">
                    <b-icon pack="fas"
                        :icon="(props.row.gender).toUpperCase() === 'MASCULINO' ? 'mars' : 'venus'"
                    >
                    </b-icon>
                    {{ props.row.gender }}
                </b-table-column>

                <b-table-column field="rfc" label="RFC" width="40" sortable numeric>
                    {{ props.row.rfc }}
                </b-table-column>

                <b-table-column field="ife_key" label="Clave del IFE" width="40" sortable numeric>
                    {{ props.row.ife_key }}
                </b-table-column>

                <b-table-column field="elector_key" label="Clave del Elector" width="40" sortable numeric>
                    {{ props.row.elector_key }}
                </b-table-column>

                <b-table-column field="phone" label="Telefono" sortable>
                    {{ props.row.phone }}
                </b-table-column>

                <b-table-column field="curp" label="CURP" sortable>
                    {{ props.row.curp }}
                </b-table-column>

                <b-table-column field="marital_statuses" label="Estado Civil" sortable>
                    {{ props.row.marital_statuses }}
                </b-table-column>

                <b-table-column field="imss" label="IMSS" sortable>
                    {{ props.row.imss }}
                </b-table-column>
                
                <b-table-column field="contract_date" label="Fecha de Contratacion" sortable centered>
                    <span class="tag is-info">
                        {{ props.row.contract_date }}
                    </span>
                </b-table-column>

                <b-table-column field="nationality_mode" label="Modo de Nacionalidad" sortable>
                    {{ props.row.nationality_mode }}
                </b-table-column>

                
                <b-table-column field="date" label="Fecha de Nacimiento" sortable centered>
                    <span class="tag is-success">
                        {{ props.row.birthdate }}
                    </span>
                </b-table-column>

                <b-table-column field="colony.municipality.state" label="Estado de Nacimiento" sortable>
                    {{ props.row.state }}
                </b-table-column>

                <b-table-column field="colony.municipality" label="Municipio de Nacimiento" sortable>
                    {{ props.row.municipality}}
                </b-table-column>

                <b-table-column field="colony" label="Colonia de Nacimiento" sortable>
                    {{ props.row.colony }}
                </b-table-column>

            </template>
        </b-table>
    </section>
</template>

<script>
export default {
  props: ['data'],
  data() {
    return {
      isPaginated: true,
      isPaginationSimple: false,
      defaultSortDirection: 'asc',
      currentPage: 1,
      perPage: 5
    }
  }
}
</script>

<style>

</style>
