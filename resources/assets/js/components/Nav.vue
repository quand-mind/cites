<!-- 
Ultima Actualización: 16/01/2020

Tipo de componente: Módulo

Donde se usa:
 Home.blade.php (layout)

Descripción:
  Menu con links a las paginas principales, se oculta en los dispositivos moviles
 -->

 <template>
  <div>
    <!-- Barra de menu2 -->
    <nav class="d-lg-flex d-xl-flex justify-content-center verde p-0  text-uppercase mw-100 collapse ">
      <!-- menu2 -->
      <ul class="d-flex w-90 h-100 m-0 align-items-stretch p-0 m-0 flex-nowrap container">
        <li class="px-2 d-flex align-items-center btn-verde"><a class="btn px-1 font-weight-bold text-white" onclick="return false">Proyecto</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu " style="top: 60%" >
            <router-link to="/proyecto/comision-nacional-de-bioseguridad"><li class="p-3 text-white font-weight-bold btn-verde">Comisión Nacional de Bioética y Bioseguridad en Salud</li></router-link>
            <router-link to="/proyecto/acuerdos-internacionales"><li class="p-3 text-white font-weight-bold btn-verde">Acuerdos Internacionales</li></router-link>
            <router-link to="/proyecto/legislacion-internacional"><li class="p-3 text-white font-weight-bold btn-verde">Legislación Internacional</li></router-link>
            <router-link to="/proyecto/antecedentes-y-justificacion"><li class="p-3 text-white font-weight-bold btn-verde">Antecedentes y Justificación</li></router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center btn-verde"><router-link to="/transgenico" class="btn p-1 font-weight-bold text-white">Qué es un transgénico</router-link></li>
        <li class="p-2 d-flex align-items-center btn-verde"><router-link to="/noticias" class="btn p-1 font-weight-bold text-white">Noticias</router-link></li>
        <li class="p-2 d-flex align-items-center btn-verde"><a onclick="return false" class="btn p-1 font-weight-bold text-white">Quienes somos</a>
                  <!-- Submenu -->
          <ul class="verde position-absolute submenu" style="top: 60%;" >
            <router-link to="/somos/grupos"><li class="p-3 text-white font-weight-bold btn-verde">Grupos</li></router-link>
            <router-link to="/somos/objetivos"><li class="p-3 text-white font-weight-bold btn-verde">Objetivos</li></router-link>
            <router-link to="/somos/mision"><li class="p-3 text-white font-weight-bold btn-verde">Misión</li></router-link>
            <router-link to="/somos/vision"><li class="p-3 text-white font-weight-bold btn-verde">Visión</li></router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center btn-verde"><router-link to="/faqs-encuestas" class="btn p-1 font-weight-bold text-white">FAQS y Encuestas</router-link></li>
        <li class="p-2 d-flex align-items-center btn-verde"><a onclick="return false" class="btn p-1 font-weight-bold text-white">Protocolo de Cartagena</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu" style="top: 60%;" >
            <router-link to="/protocolo/mitos-realidades"><li class="p-3 text-white font-weight-bold btn-verde">Mitos y Realidades</li></router-link>
            <router-link to="/protocolo/ovm-territorio-nacional"><li class="p-3 text-white font-weight-bold btn-verde">¿Qué hacer si entra otro tipo de OVM al territorio nacional?</li></router-link>
            <router-link to="/protocolo/faqs"><li class="p-3 text-white font-weight-bold btn-verde">FAQS sobre el protocolo</li></router-link>
            <router-link to="/protocolo/recursos"><li class="p-3 text-white font-weight-bold btn-verde">Recursos</li></router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center btn-verde"><a onclick="return false" class="btn p-1 font-weight-bold text-white">Proyectos asociados</a>
          <!-- Submenu -->
          <ul class="verde position-absolute submenu" style="top: 60%;" >
            <router-link to="/asociados/nagoya-lumpur"><li class="p-3 text-white font-weight-bold btn-verde">Nagoya-Lumpur</li></router-link>
          </ul>
        </li>
        <li class="p-2 d-flex align-items-center btn-verde"><router-link to="/laboratorio-nacional-ovm" class="btn p-1 font-weight-bold text-white">Lab. Nacional de detección de OVM</router-link></li>
        <li class="p-2 d-flex align-items-center btn-verde"><a onclick="return false" class="btn p-1 font-weight-bold text-white">Recursos</a>
        <!-- Submenu -->
          <ul class="verde position-absolute submenu" style="top: 60%;" >
            <router-link to="/recursos/ovm-venezuela"><li class="p-3 text-white font-weight-bold btn-verde">Información sobre OVM en Venezuela</li></router-link>
            <router-link to="/recursos/portales"><li class="p-3 text-white font-weight-bold btn-verde">Portales de la temática</li></router-link>
            <router-link to="/recursos/formularios"><li class="p-3 text-white font-weight-bold btn-verde">Formularios de uso Común</li></router-link>
            <router-link to="/recursos/mapa-del-sitio"><li class="p-3 text-white font-weight-bold btn-verde">Mapa del sitio</li></router-link>
            <router-link to="/recursos/glosario"><li class="p-3 text-white font-weight-bold btn-verde">Glosario</li></router-link>
          </ul>
        </li>
      </ul>
    </nav> 

  </div>
</template>

<script>
export default {
  name: 'nav1',
}
</script>

<style scoped>
  .submenu{
    max-width: 250px;
    display: none;
  }
  nav ul li:hover > .submenu{
    display: block;
    z-index: 1000;
  }
  
*{
  box-sizing: content-box;
  padding: 0px;
  margin: 0px;
}
li{
  list-style: none;
}
</style>
