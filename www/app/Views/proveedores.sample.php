<!--Inicio HTML -->
<div class="row">       
    <div class="col-12">
        <div class="card shadow mb-4">
            <form method="get" action="/proveedores">
                <input type="hidden" name="order" value="1"/>
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>                                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!--<form action="./?sec=formulario" method="post">                   -->
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="alias">Alias:</label>
                                <input type="text" class="form-control" name="alias" id="alias" value="" />
                            </div>
                        </div>  
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="nombre_completo">Nombre completo:</label>
                                <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="" />
                            </div>
                        </div> 
                        <div class="col-12 col-lg-3">
                            <div class="mb-3">
                                <label for="id_tipo">Tipo:</label>
                                <select name="id_tipo[]" id="id_tipo" class="form-control select2" data-placeholder="Tipo proveedor" multiple>
                                    <option value="">-</option>
                                    <option value="3" >Componentes móviles</option>
                                    <option value="4" >Componentes PC</option>                                                                            
                                </select>
                            </div>
                        </div> 
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_continente">Continente:</label>
                                <select name="id_continente" id="id_continente" class="form-control" data-placeholder="Continente">
                                    <option value="">-</option>
                                    <option value="1" >Europa</option>
                                    <option value="2" >Asia</option>                                                                            
                                </select>
                            </div>
                        </div>                        
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="anho_fundacion">Año fundación:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="min_anho" id="min_anho" value="" placeholder="Mí­nimo" />
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="max_anho" id="max_anho" value="" placeholder="Máximo" />
                                    </div>
                                </div>
                            </div>
                        </div>                           
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/proveedores" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Proveedores</h6>                                    
            </div>
            <!-- Card Body -->
            <div class="card-body" id="card_table">
                <div id="button_container" class="mb-3"></div>
                <!--<form action="./?sec=formulario" method="post">                   -->
                <table id="tabladatos" class="table table-striped">                    
                    <thead>
                        <tr>
                            <th><a href="/proveedores?order=1">Alias</a> <i class="fas fa-sort-amount-down-alt"></i></th>
                            <th><a href="/proveedores?order=2">Nombre Completo</a> </th>
                            <th><a href="/proveedores?order=3">Tipo</a> </th>
                            <th><a href="/proveedores?order=4">Continente</a> </th>
                            <th><a href="/proveedores?order=5">Año fundación</a> </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td>CuCoMa</td>
                            <td>Custom Comp. Mov. Martínez</td>
                            <td>Componentes móviles</td>
                            <td>Europa</td>
                            <td>1992</td> 
                            <td>                                        
                                <a href="tel: 931506210" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="931506210"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@cucoma.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@cucoma.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://cucoma.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>CuPaOr</td>
                            <td>Custom Papelería Orge</td>
                            <td>Papelería</td>
                            <td>Europa</td>
                            <td>1966</td> 
                            <td>                                        
                                <a href="tel: 923353006" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="923353006"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@cupaor.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@cupaor.net"><i class="fas fa-envelope"></i></a>                                        
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>CuPCFe</td>
                            <td>Custom PC Parts Ferreira</td>
                            <td>Componentes PC</td>
                            <td>América</td>
                            <td>1918</td> 
                            <td>                                        
                                <a href="tel: 955150786" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="955150786"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@cupcfe.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@cupcfe.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://cupcfe.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>CuWeGo</td>
                            <td>Custom Web González</td>
                            <td>Hosting</td>
                            <td>Europa</td>
                            <td>1891</td> 
                            <td>                                        
                                <a href="tel: 994512272" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="994512272"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@cuwego.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@cuwego.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://cuwego.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>CuWePa</td>
                            <td>Custom Web Paz</td>
                            <td>Hosting</td>
                            <td>Europa</td>
                            <td>1866</td> 
                            <td>                                        
                                <a href="tel: 986718207" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="986718207"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@cuwepa.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@cuwepa.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://cuwepa.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCaCa</td>
                            <td>Experienced Cartones Cabaleiro</td>
                            <td>Embalajes</td>
                            <td>Europa</td>
                            <td>2006</td> 
                            <td>                                        
                                <a href="tel: 985516071" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="985516071"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excaca.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excaca.net"><i class="fas fa-envelope"></i></a>                                        
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>ExCaGo</td>
                            <td>Extrem Cartones González</td>
                            <td>Embalajes</td>
                            <td>Asia</td>
                            <td>1878</td> 
                            <td>                                        
                                <a href="tel: 931788422" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="931788422"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excago.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excago.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://excago.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCaJu</td>
                            <td>Experienced Cartones Juncal</td>
                            <td>Embalajes</td>
                            <td>Europa</td>
                            <td>1965</td> 
                            <td>                                        
                                <a href="tel: 920423537" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="920423537"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excaju.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excaju.net"><i class="fas fa-envelope"></i></a>                                        
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCaMa</td>
                            <td>Extrem Cartones Martínez</td>
                            <td>Embalajes</td>
                            <td>Europa</td>
                            <td>1917</td> 
                            <td>                                        
                                <a href="tel: 901235058" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="901235058"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excama.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excama.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://excama.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCaMa</td>
                            <td>Extrem Cartones Martínez</td>
                            <td>Embalajes</td>
                            <td>Europa</td>
                            <td>1914</td> 
                            <td>                                        
                                <a href="tel: 918121354" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="918121354"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excama.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excama.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://excama.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>ExCaMí</td>
                            <td>Experienced Cartones Míguez</td>
                            <td>Embalajes</td>
                            <td>Asia</td>
                            <td>1871</td> 
                            <td>                                        
                                <a href="tel: 957730280" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="957730280"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excamí.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excamí.net"><i class="fas fa-envelope"></i></a>                                        
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCaOr</td>
                            <td>Experienced Cartones Orge</td>
                            <td>Embalajes</td>
                            <td>Europa</td>
                            <td>1984</td> 
                            <td>                                        
                                <a href="tel: 908932066" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="908932066"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excaor.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excaor.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://excaor.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCoGo</td>
                            <td>Extrem Comp. Mov. González</td>
                            <td>Componentes móviles</td>
                            <td>Europa</td>
                            <td>1994</td> 
                            <td>                                        
                                <a href="tel: 966564388" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="966564388"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excogo.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excogo.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://excogo.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCoMí</td>
                            <td>Extrem Comp. Mov. Míguez</td>
                            <td>Componentes móviles</td>
                            <td>Europa</td>
                            <td>1967</td> 
                            <td>                                        
                                <a href="tel: 901934742" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="901934742"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excomí.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excomí.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://excomí.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExCoNa</td>
                            <td>Experienced Comp. Mov. Navarrete</td>
                            <td>Componentes móviles</td>
                            <td>Europa</td>
                            <td>1922</td> 
                            <td>                                        
                                <a href="tel: 962832573" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="962832573"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@excona.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@excona.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://excona.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExEnCa</td>
                            <td>Experienced Envíos Cabaleiro</td>
                            <td>Paquetería</td>
                            <td>Europa</td>
                            <td>1925</td> 
                            <td>                                        
                                <a href="tel: 995135249" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="995135249"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exenca.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exenca.net"><i class="fas fa-envelope"></i></a>                                        
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>ExEnFe</td>
                            <td>Experienced Envíos Fernández</td>
                            <td>Paquetería</td>
                            <td>Asia</td>
                            <td>1962</td> 
                            <td>                                        
                                <a href="tel: 965982643" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="965982643"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exenfe.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exenfe.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://exenfe.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>ExEnGo</td>
                            <td>Experienced Envíos González</td>
                            <td>Paquetería</td>
                            <td>América</td>
                            <td>1861</td> 
                            <td>                                        
                                <a href="tel: 997733824" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="997733824"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exengo.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exengo.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://exengo.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>ExEnRo</td>
                            <td>Experienced Envíos Rodríguez</td>
                            <td>Paquetería</td>
                            <td>Asia</td>
                            <td>1924</td> 
                            <td>                                        
                                <a href="tel: 988346270" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="988346270"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exenro.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exenro.net"><i class="fas fa-envelope"></i></a>                                        
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExObAc</td>
                            <td>Extrem Obras Acuña</td>
                            <td>Construcciones</td>
                            <td>Europa</td>
                            <td>1979</td> 
                            <td>                                        
                                <a href="tel: 960723778" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="960723778"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exobac.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exobac.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://exobac.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExObFe</td>
                            <td>Extrem Obras Ferreira</td>
                            <td>Construcciones</td>
                            <td>Europa</td>
                            <td>1904</td> 
                            <td>                                        
                                <a href="tel: 964120771" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="964120771"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exobfe.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exobfe.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://exobfe.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>ExObPa</td>
                            <td>Experienced Obras Paz</td>
                            <td>Construcciones</td>
                            <td>Asia</td>
                            <td>1950</td> 
                            <td>                                        
                                <a href="tel: 925998081" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="925998081"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exobpa.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exobpa.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://exobpa.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="table-warning">
                            <td>ExPaAc</td>
                            <td>Experienced Papelería Acuña</td>
                            <td>Papelería</td>
                            <td>Asia</td>
                            <td>1997</td> 
                            <td>                                        
                                <a href="tel: 985174420" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="985174420"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@expaac.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@expaac.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://expaac.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExPaRo</td>
                            <td>Extrem Papelería Rodríguez</td>
                            <td>Papelería</td>
                            <td>Europa</td>
                            <td>1922</td> 
                            <td>                                        
                                <a href="tel: 945087019" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="945087019"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@exparo.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@exparo.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://exparo.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ExPCPé</td>
                            <td>Experienced PC Parts Pérez</td>
                            <td>Componentes PC</td>
                            <td>Europa</td>
                            <td>1850</td> 
                            <td>                                        
                                <a href="tel: 908080337" target="_blank" class="btn btn-success ml-1" data-toggle="tooltip" data-placement="top" title="908080337"><i class="fas fa-phone"></i></a>
                                <a href="mailto: info@expcpé.net" target="_blank" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="info@expcpé.net"><i class="fas fa-envelope"></i></a>                                        
                                <a href="http://expcpé.net" target="_blank" class="btn btn-light ml-1"><i class="fas fa-globe-europe"></i></a>
                            </td>
                        </tr>
                    </tbody>                    
                </table>
            </div>
            <div class="card-footer">
                <nav aria-label="Navegacion por paginas">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="/proveedores?page=1&order=1" aria-label="First">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">First</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/proveedores?page=2&order=1" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <li class="page-item active"><a class="page-link" href="#">3</a></li>   
                        <li class="page-item">
                            <a class="page-link" href="/proveedores?page=4&order=1" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/proveedores?page=8&order=1" aria-label="Last">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Last</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>                        
</div>
<!--Fin HTML -->