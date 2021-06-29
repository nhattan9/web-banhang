<div class="container">
<h1 class="h3 mb-2 text-gray-800">Thêm thuộc tính  </h1>
<br>
<div class="form-group">
    <label for="my-input">Tên sản phẩm </label>
    <input class="form-control" type="pro_name" name="" value="<?=$product['name'] ?>" readonly>
</div>
<form method="POST" action="" enctype="multipart/form-data" id="act_form">
        <div class="field_wrapper mb-2">
            <div class="mb-2">
            <input class="form-control" type="hidden" name="pro_id" value="<?=$product['id'] ?>">
            <input type="text" class="form-control" name="size[]" placeholder="Size" style="width: 22% ;margin: 2px;float: left;" value=""/>
            <input type="text" class="form-control" name="color[]" placeholder="Color"  style="width: 22% ;margin: 2px;float: left;" value=""/>
            <input type="file" class="form-control"name="image[]" placeholder="Image" style="width: 22% ;margin: 2px;float: left;"  value=""/>
            <input type="text" class="form-control" name="stock[]" placeholder="Stock" style="width: 22% ;margin: 2px;float: left;"  value=""/>
            <a href="javascript:void(0);" class="add_button" title="Add field"><span class="btn btn-primary btn-circle"><i class="fas fa-plus"></i></span></a> </div>
        </div>
        <input name="submit" id="btn_submit" class="btn btn-danger mx-auto" type="button" value="Cập nhập">
</form>


<div class="card shadow mt-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bảng thuộc tính </h6>
                        </div>
                        <div class="card-body">
                            <div class="table text-center">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12"><table class="table  dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                        <tr role="row "><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 25%;">Image</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width:  25%;">Size</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width:  25%;">Color</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width:  25%;">Stock</th><th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width:  25%;">Action</th>
                                    </thead>
                                    <tbody>
                                    <?php foreach($attr as $attri):?> 
                                         <tr class="odd ">
                                            <td><img src="<?=STATIC_DIR."uploads/".$attri['image'] ?>" alt="" style="max-width:100px;"></td>
                                            <td><?= $attri['size'] ?></td>
                                            <td><i class="fas fa-circle" style="color:<?= $attri['color']?>"></i></td>
                                            <td><?= $attri['stock'] ?></td>
                                            <td><button class="btn btn-danger btn-circle"  onclick="deleteAttr(<?=$attri['id']?>)" ><i class="fas fa-trash"></i></button></td>
                                           
                                        </tr>
                                     <?php endforeach;?>
                                    </tbody>
                                </table></div></div></div>
                            </div>
                        </div>
                    </div>
                  </div>

<script type="text/javascript">

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = ' <div class="mb-2"><input type="text" class="form-control" name="size[]" placeholder="Size" style="width: 22% ;margin: 2px;float: left;" value=""/><input type="text" class="form-control" name="color[]" placeholder="Color"  style="width: 22% ;margin: 2px;float: left;" value=""/><input type="file" class="form-control"name="image[]" placeholder="Image" style="width: 22% ;margin: 2px;float: left;"  value=""/><input type="text" class="form-control" name="stock[]" placeholder="Stock" style="width: 22% ;margin: 2px;float: left;"  value=""/><a href="javascript:void(0);" class="remove_button" title="Add field"><span class="btn btn-danger btn-circle "><i class="fas fa-trash"></i></span></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });




// ADD ATTRIBUTE
$("#btn_submit").click(function () {
     
        // console.log(window.location.href);
         var form =$('#act_form')[0]
         var data = new FormData(form);
        //Post to server
        $.ajax({
            type: "POST",
            url: "?controller=attribute&action=add",
            processData: false,
            mimeType: "multipart/form-data",
            contentType: false,
            data: data,
            success: function (response) {
                console.log(response)
                location.reload();

            }
        });
    });
    


});
function deleteAttr(id){
        var options = confirm('Are you sure you want to delete');
        if(!options){
            return;
        }
        
        $.post('?controller=attribute&action=delete', { "id":id }, 
        function(data){
        alert(data);
        location.reload();
        }); 
    }
</script>
