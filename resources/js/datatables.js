const BASE_URL = "http://localhost:8000"

export const DATA_TABLE_PRESET = {
    scrollX: true,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, 'All']
    ],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    },
    "columns": [{
            "data": "n_ATM"
        },
        {
            "data": "n_ATM" //"ubicaciones.0.provincia"
        },
        {
            "data": "especialidad_formativa"
        },
        {
            "data": "especialidad_formativa"
        }
    ]
}


export const getAulasOverview = new Promise(async (resolve, reject) => {
    const res = await fetch(`${BASE_URL}/api/aulas-moviles-overview`)
    if (!res.ok) reject("Error fetching classrooms list.")

    const jsonRes = await res.json()
    console.log(jsonRes)
    resolve(jsonRes)
})

export const updateTable = (aulasList, filters, table) => {
    const filteredAulasList = aulasList.filter((item) => {
        return (item.especialidad_formativa.toLowerCase().includes(filters.especialidad.toLowerCase()) || especialidadSelector.value == "") //&&
        //(item.ubicaciones[0].provincia == provinciaSelector.value || provinciaSelector.value == "")
    })

    console.log(filteredAulasList)

    table.DataTable().destroy()
    table.DataTable({
        ...DATA_TABLE_PRESET,
        data: filteredAulasList
    })
    table.DataTable().draw()
}
