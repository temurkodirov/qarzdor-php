const deleteWindow = document.querySelector("#deleteWindow");
const deleteConfirm = document.querySelector('#linkdelete');

function deleteF(id) {
    deleteWindow.style.display = "block"; // show div
    deleteConfirm.setAttribute('href', 'vendor/delete.php?id=' + id);
    }
function closef() {
    deleteWindow.style.display = "none"; // show div
    }


function editF(id) {
    console.log(id);
    editWindow.style.display = "block";

    $.ajax({
        url: 'vendor/getPost.php?id=' +id,
        method: 'get',
        cache: false,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            document.querySelector('#name').setAttribute('value', data.data.name);
            document.querySelector('#comment').setAttribute('value', data.data.comment);
            document.querySelector('#contact').setAttribute('value', data.data.contact);
            document.querySelector('#adress').setAttribute('value', data.data.adress);
            document.querySelector('#amount').setAttribute('value', data.data.amount);
            document.querySelector('#gDate').setAttribute('value', data.data.gDate);
            document.querySelector('#rDate').setAttribute('value', data.data.rDate);
            document.querySelector('#id').setAttribute('value', data.data.id);
        }
    });
}

const editWindow = document.querySelector("#editWindow");
function closeef(){
    editWindow.style.display = "none";
    }