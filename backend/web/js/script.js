/**
 * Created by bankchart on 14/10/2559.
 */
var models = {
    init : function(){},
    assign2Make : function(baseUrl, makeId, modelId){
        $.ajax({
            url : baseUrl + '/model/assign-to-make',
            type : 'post',
            data : {
                'MakeHasModel': { make_id : makeId, model_id : modelId }
            },
            success : function(data){
                if(data == 'success') location.reload();
                else alert(data);
            }
        });
    },
    getModelByMake : function(baseUrl, elmObject){
        var makeId = elmObject.value;
        $.ajax({
            url : baseUrl + '/model/get-model-by-make',
            type : 'post',
            dataType : 'json',
            data : { makeId : makeId },
            success : function(data){
                var obj = $('#model_id');
                obj.empty();
                obj.append($('<option value>choose model</option>'));
                $.each(data, function(index, item){
                    obj.append($('<option></option>').attr('value', item.id).text(item.name));
                });
                // console.table(data);
            }
        });
    },
    chooseSlide : function(obj){
        var cls = obj.attr('class');
        var src = obj.attr('src');
        cls = cls.replace('img-gray', '');
        cls = cls.trim();
        $('.' + cls).removeClass('img-gray');
        $('.' + cls).addClass('img-gray');
        obj.toggleClass('img-gray');
        var slide_id = cls.split('-');
        var updateBtnId = '#choose-slide-' + slide_id[2];
        // console.log('before chooseId : ' + updateBtnId + ', data-src : ' + $(updateBtnId).data('id-src'));
        $(updateBtnId).data('id-src', slide_id[2] + '-' + src);
        $('#id-src-' + slide_id[2]).val($(updateBtnId).data('id-src'));
        // console.log('after chooseId : ' + updateBtnId + ', data-src : ' + $(updateBtnId).data('id-src'));
    },
    addSlide : function(obj){
        return obj.data('id-src') === 'empty' ? false : true;
    },
    /*getEditorCaptionTextarea : function(obj, slideId){
        $.ajax({
            url : baseUrl + 'get-caption-text-area',
            type : 'post',
            dataType : 'json',
            data : {slideId : slideId},
            success : function(data){
                if(data.result === true)
                    obj.html(data.html);
                else
                    obj.html('Failure...');
            }
        });
    }*/
    assign2Category : function(catId, subcatId){
        $.ajax({
            url : baseUrl + 'sub-category/assign-to-category',
            type : 'post',
            data : {
                'CategoryHasSubCategory': { category_id : catId, sub_category_id : subcatId }
            },
            success : function(data){
                if(data == 'success') location.reload();
                else alert(data);
            }
        });
    },
    getSubCatByCat : function(obj){
        $.ajax({
            url : baseUrl + 'car/get-sub-cat-by-cat',
            type : 'post',
            data : {id:obj.value},
            success : function(data){
                $('#sub-category_id').html(data);
            }
        });
    },
    updateDisplayCategory : function(obj){
        $.ajax({
            url : baseUrl + 'car/update-display-category',
            type : 'post',
            data : {
                car_id : $('#' + obj.id).data('carid'),
                category_id : $('#category_id').val(),
                sub_category_id : $('#sub-category_id').val()
            },
            success : function(data){
                $('#display-category').html(data);
            }
        });
    },
    removeCategory : function(carid, catid, subcatid){
        $.ajax({
            url : baseUrl + 'car/remove-category',
            type : 'post',
            data : {
                category_id : catid,
                sub_category_id : subcatid,
                car_id : carid
            },
            success : function(data){
                $('#display-category').html(data);
            }
        });
    }
}