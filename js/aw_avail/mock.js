AwavRegistry = Class.create(
    {
        initialize:function (product, url) {
            this.productId = product;
            this.url = url;
        },
        callController:function () {
            $('aw_avail_stock_wrapper').update($('aw_avail_loader').innerHTML);
            new Ajax.Request(this.url,
                {
                    method:'post',
                    parameters:{id:this.productId},
                    onSuccess:function (resp) {
                        var response = resp.responseText || " ";
                        $('aw_avail_stock_wrapper').update(response);
                    },
                    onFailure:function (resp) {
                        var response = resp.responseText || " ";
                        $('aw_avail_stock_wrapper').update(response);
                    }
                }
            );
        }
    }
);