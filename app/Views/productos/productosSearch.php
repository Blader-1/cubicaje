<link rel="stylesheet" href="<?php echo base_url(); ?>/css/merca.css">

<script src="https://unpkg.com/qrious@4.0.2/dist/qrious.js"></script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div>
                <div>
                    <div class="container-inputs">
                        <div class="block">
                            <h2>MERCANCIA</h2>
                            <div class="search">
                                <form method="get" action="<?= base_url('productos/buscarInput') ?>">
                                    <div class="row-search">
                                        <input type="text" name="search" class="form-control" autocomplete="off"
                                            placeholder="Buscar...">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                        <a href="<?php echo base_url(); ?>/productos/nuevo" class="btn
                                          btn-warning">+</a>
                                    </div>
                                </form>
                            </div>

                            <div class="column">
                                <div class="table-container">
                                    <div class="table-responsive">
                                        <table id="datatablesSimple">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Código</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Cantidad</th>
                                                    <th>Vol.m3</th>
                                                    <th>Peso/total</th>
                                                    <th>Imagen</th>
                                                    <th>QR</th>
                                                    <th>Editar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Aquí se generarán las filas de la tabla dinámicamente -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            

            document.addEventListener('DOMContentLoaded', function () {
                var productos = <?php echo json_encode($productos); ?>; // Asigna tus datos PHP aquí
                var tableBody = document.querySelector('#datatablesSimple tbody');

                productos.forEach(function (producto) {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                <td>${producto.id}</td>
                <td>${producto.codigo}</td>
                <td>${producto.nombre}</td>
                <td>${producto.tipo}</td>
                <td>${producto.cantidad}</td>
                <td>${producto.vol_m}</td>
                <td>${producto.peso_total}</td>
                <td><img src="<?php echo base_url(); ?>/images/productos/${producto.id}.jpg" width="100" /></td>
                <td><img class="imgQR" id="codigo-${producto.id}" /></td>
                <td><a href="<?php echo base_url(); ?>/productos/editar/${producto.id}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td><a href="#" data-href="<?php echo base_url(); ?>/productos/eliminar/${producto.id}" data-bs-toggle="modal" data-bs-target="#modal-confirma" data-bs-placement="top" title="Eliminar Registro" class="btn btn-dark"><i class="fa-solid fa-trash-can"></i></a></td>
            `;
                    tableBody.appendChild(row);

                    var qrElement = row.querySelector(`#codigo-${producto.id}`);
                    var merca = {
                        codigoMerca: producto.codigo,
                        nombreMerca: producto.nombre,
                        tipoMerca: producto.tipo
                    };
                    var qr = JSON.stringify(merca);

                    new QRious({
                        element: qrElement,
                        value: qr,
                        size: 80,
                        backgroundAlpha: 0,
                        foreground: "#000000",
                        level: "L"
                    });
                });
            });
        </script>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                    <a class="btn btn-danger btn-ok">Si</a>
                </div>
            </div>
        </div>
    </div>
    <div class="help-box">
        <a href="https://www.uniclaretiana.edu.co/#atencion">
            <i class="fas fa-question-circle"></i> Ayuda
        </a>
    </div>
</div>