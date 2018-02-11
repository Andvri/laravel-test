<template>
    <b-table
        :data="data"
        :opened-detailed="defaultOpenedDetails"
        detailed
        detail-key="id"
        @details-open="(row, index) => $toast.open(`Errores de: ${row.nombres}`)"
        narrowed
        bordered
        >

        <template slot-scope="props">
          <b-table-column field="company.name" label="Compañia" sortable>
              {{ props.row.empresa }}
          </b-table-column>
          <b-table-column field="names" label="Nombres" sortable>
              {{ props.row.nombres }}
          </b-table-column>

          <b-table-column field="paternal_surname" label="Apellido Paterno" sortable>
              {{ props.row.apellido_paterno }}
          </b-table-column>

          <b-table-column field="maternal_surname" label="Apellido Materno" sortable>
              {{ props.row.apellido_materno }}
          </b-table-column>

          
          <b-table-column label="Genero">
            {{ props.row.sexo }}
          </b-table-column>

          <b-table-column field="rfc" label="RFC" width="40" sortable numeric>
              {{ props.row.rfc }}
          </b-table-column>

          <b-table-column field="ife_key" label="Clave del IFE" width="40" sortable numeric>
              {{ props.row.clave_del_ife }}
          </b-table-column>

          <b-table-column field="elector_key" label="Clave del Elector" width="40" sortable numeric>
              {{ props.row.clave_del_elector }}
          </b-table-column>

          <b-table-column field="phone" label="Telefono" sortable>
              {{ props.row.telefono }}
          </b-table-column>

          <b-table-column field="curp" label="CURP" sortable>
              {{ props.row.curp }}
          </b-table-column>

          <b-table-column field="marital_statuses" label="Estado Civil" sortable>
              {{ props.row.estado_civil }}
          </b-table-column>

          <b-table-column field="imss" label="IMSS" sortable>
              {{ props.row.afiliacion_a_imss }}
          </b-table-column>
          
          <b-table-column field="contract_date" label="Fecha de Contratacion" sortable centered>
              <span class="tag is-info">
                  {{ props.row.fecha_de_contrato }}
              </span>
          </b-table-column>

          <b-table-column field="nationality_mode" label="Modo de Nacionalidad" sortable>
              {{ props.row.modo_de_nacionalidad }}
          </b-table-column>

          
          <b-table-column field="date" label="Fecha de Nacimiento" sortable centered>
              <span class="tag is-success">
                  {{ props.row.fecha_de_nacimiento }}
              </span>
          </b-table-column>

          <b-table-column field="colony.municipality.state" label="Estado de Nacimiento" sortable>
              {{ props.row.entidad_de_nacimiento }}
          </b-table-column>

          <b-table-column field="colony.municipality" label="Municipio de Nacimiento" sortable>
              {{ props.row.municipio_de_nacimiento}}
          </b-table-column>

          <b-table-column field="colony" label="Colonia de Nacimiento" sortable>
              {{ props.row.colonia_de_nacimiento }}
          </b-table-column>
        </template>

        <template slot="detail" slot-scope="props">
            <article class="media">
               <ul>
                 <li v-for="(err,i) in props.row.errs" :key="i">
                   {{err}}
                 </li>
               </ul>
            </article>
        </template>
    </b-table>
</template>

<script>
    export default {
      props: ['data'],
      data() {
        return {
            defaultOpenedDetails: [1]
        }
      }
    }
</script>
