function loadPage() {
    let helper = new Helper();
    const configTablaMarca = {
        ...helper.configuracionDataTable,
        "ajax": {
            "url": helper.urlMarcas,
            "method" : "POST",
            "data": function ( d ) {
                d.accion = 'ver-marcas';
            }
        },
        columns: [
            {
                data: 'id',
                render: function(data,type,row, meta){
                    return meta.row + 1;
                }
            },
            {
                data: 'nombreMarca'
            },
            
            {
                data: 'id',
                render : function(data){
                    return `<div class="d-flex justify-content-center" style="gap:5px;"><button class="btn btn-sm btn-outline-info p-1" data-marca="${data}">
                        <small>
                        <i class="fas fa-pencil-alt"></i>
                        Editar
                        </small>
                    </button>
                    <button class="btn btn-sm btn-outline-danger p-1" data-marca="${data}">
                        <small>    
                        <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </small>
                    </button></div>`
                }
            }
        ]
    }
    const datatableMarca = $('#misMarcas').DataTable(configTablaMarca);
    const tablaMisMarca = document.querySelector("#misMarcas");
    const modalEditarMarca = document.querySelector("#marcaModal");
    const modalMarca = new bootstrap.Modal(modalEditarMarca);
    tablaMisMarca.querySelector("tbody").addEventListener("click",async function(event){
        if(event.target.classList.contains("btn-outline-info")){
            modalMarca.show();
        }
        //
        if(event.target.classList.contains("btn-outline-danger")){
            const idMarca = event.target.dataset.marca;
            try {
                const alertaSweet = await helper.sweetAlertConfirm(null,"¿Deseas eliminar esta marca?");
                if(alertaSweet.isConfirmed){
                    let datos = new FormData();
                    datos.append("accion","eliminar-marca");
                    datos.append("idMarca",idMarca);
                    const response = await helper.peticionHttp(helper.urlMarcas,"POST",datos);
                    if(response.success){
                        datatableMarca.ajax.reload();
                    }
                    helper.alertaToast(response.success ? "success" : "error", response.success ? response.success : "Error al eliminar la marca");
                }
            } catch (error) {
                helper.alertaToast("error","error al eliminar la marca");
                console.error(error);
            }
        }
    });

    const btnModalMarca= document.querySelector("#btnModalMarca");
    const frmMarca = document.querySelector("#frmMarcas ");
    btnModalMarca.onclick = e => document.querySelector("#btnSubmitFrmMarca").click();
    frmMarca.addEventListener("submit",async function(e){
        e.preventDefault();
        // return Swal.fire({
        //     icon: 'error',
        //     text: 'El nombre de la marca solo acepta letras y/o números'
        // });
        let datos = new FormData(this);
        datos.append("accion","agregar-marca");
        try {
            const response = await helper.peticionHttp(helper.urlMarcas,"POST",datos);
            if(response.success){
                modalMarca.hide();
                datatableMarca.ajax.reload();
                helper.sweetAlert("success",null,response.success);
                this.reset();
            }else if(response.error){
                helper.sweetAlert("error",null,response.error);
            }
        } catch (error) {
            console.error(error);
            helper.sweetAlert("error",null,"Error al agregar marca");
        }
    })
    
}
window.addEventListener("DOMContentLoaded",loadPage);