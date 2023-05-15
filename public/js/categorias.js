function loadPage() {
    let helper = new Helper();
    const configTablaCategoria = {
        ...helper.configuracionDataTable,
        "ajax": {
            "url": helper.urlCategorias,
            "method" : "POST",
            "data": function ( d ) {
                d.accion = 'ver-categorias';
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
                data: 'nombreCategoria'
            },
            
            {
                data: 'id',
                render : function(data){
                    return `<div class="d-flex justify-content-center" style="gap:5px;"><button class="btn btn-sm btn-outline-info p-1" data-categoria="${data}">
                        <small>
                        <i class="fas fa-pencil-alt"></i>
                        Editar
                        </small>
                    </button>
                    <button class="btn btn-sm btn-outline-danger p-1" data-categoria="${data}">
                        <small>    
                        <i class="fas fa-trash-alt"></i>
                            Eliminar
                        </small>
                    </button></div>`
                }
            }
        ]
    }
    const datatableCategoria = $('#misCategorias').DataTable(configTablaCategoria);
    const tablaMisCategoria = document.querySelector("#misCategorias");
    const modalEditarCategoria = document.querySelector("#categoriaModal");
    const modalCategoria = new bootstrap.Modal(modalEditarCategoria);
    tablaMisCategoria.querySelector("tbody").addEventListener("click",async function(event){
        if(event.target.classList.contains("btn-outline-info")){
            modalCategoria.show();
        }
        //
        if(event.target.classList.contains("btn-outline-danger")){
            const idCategoria = event.target.dataset.categoria;
            try {
                const alertaSweet = await helper.sweetAlertConfirm(null,"¿Deseas eliminar esta categoría?");
                if(alertaSweet.isConfirmed){
                    let datos = new FormData();
                    datos.append("accion","eliminar-categoria");
                    datos.append("idCategoria",idCategoria);
                    const response = await helper.peticionHttp(helper.urlCategorias,"POST",datos);
                    if(response.success){
                        datatableCategoria.ajax.reload();
                    }
                    helper.alertaToast(response.success ? "success" : "error", response.success ? response.success : "Error al eliminar la categoría");
                }
            } catch (error) {
                helper.alertaToast("error","error al eliminar la categoría");
                console.error(error);
            }
        }
    });

    const btnModalCategoria= document.querySelector("#btnModalCategoria");
    const frmCategoria = document.querySelector("#frmCategorias ");
    btnModalCategoria.onclick = e => document.querySelector("#btnSubmitFrmCategoria").click();
    frmCategoria.addEventListener("submit",async function(e){
        e.preventDefault();
        // return Swal.fire({
        //     icon: 'error',
        //     text: 'El nombre de la categoría no debe estar vacía'
        // });
        let datos = new FormData(this);
        datos.append("accion","agregar-categoria");
        try {
            const response = await helper.peticionHttp(helper.urlCategorias,"POST",datos);
            if(response.success){
                modalCategoria.hide();
                datatableCategoria.ajax.reload();
                helper.sweetAlert("success",null,response.success);
                this.reset();
            }else if(response.error){
                helper.sweetAlert("error",null,response.error);
            }
        } catch (error) {
            console.error(error);
            helper.sweetAlert("error",null,"Error al agregar categoría");
        }
    })
    
}
window.addEventListener("DOMContentLoaded",loadPage);