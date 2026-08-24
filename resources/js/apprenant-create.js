import $ from 'jquery';
import { Input } from 'postcss';

const all_niveau = ['', 'CE2', 'CM1', 'CM2', '6ème trimestriel', '6ème semestriel', '5ème trimestriel', '5ème semestriel', '4ème trimestriel', '4ème semestriel',
    '3ème trimestriel', '3ème semestriel', 'Seconde trimestriel', 'Seconde semestriel', 'Première trimestriel', 'Première semestriel', 'Terminale trimestriel', 'Terminale semestriel']


let niveau_id = $('#niveau_id').val();
function get_niveau_id() {
    niveau_id = $('#niveau_id').val();

}
function add_row() {
    const table_body = $('#tbody')
    console.log(table_body)
    table_body.empty();
    let bladeInputHtml = $('#file-input-template').html();
    
    let td_input = `<td class="px-3 py-3 text-center align-middle min-w-[200px]">
                        ${bladeInputHtml}
                    </td>`;
    let ajout = ''

    for(let i = 1;i<=niveau_id;i++){
        let rest = "<tr class='border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50/50 dark:hover:bg-white/[0.01]'>";
        let td_niveau = `<td class="px-5 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-sm align-middle">
                            ${all_niveau[i]}
                         </td>`;
        rest += td_niveau
        for(let j = 0;j<4;j++){
            rest += td_input
        }
        rest += "</tr>"
        ajout += rest
    }
    table_body.append(ajout);
    console.log('erfgzefzjbfzeuibfuiozhfzihhuieh')
    console.log(ajout)
}


const button_ajouter_bulletins = $('#ajouter-bulletins')
let btn_est_clicker = false
button_ajouter_bulletins.on('click', function () {
    const div_table_bulltins = $('#table_bulltins')
    div_table_bulltins.css({
        'display': 'block'
    });
    btn_est_clicker = true
    get_niveau_id()
    add_row()

});

if(btn_est_clicker){
    
    console.log('vevesvee')
}

