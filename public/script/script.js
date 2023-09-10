let button = document.getElementById('togglemode');
let body = document.body;
button.addEventListener('click',
()=>{
    body.classList.toggle('dark');
console.log('Clicked');
});


let increasebutton = document.getElementById('cartinc');
let decreasebutton = document.getElementById('cartdec');
let cartnumber = document.getElementById('Quantity');
if(increasebutton || decreasebutton){
    increasebutton.addEventListener('click',()=>{
    cartnumber.value++;
});
decreasebutton.addEventListener('click',()=>{
    if(cartnumber.value==1){
        //Do Nothing
    }
    else{
       cartnumber.value--; 
    }
});
}

let updatebutton = document.querySelectorAll('#updateProductButton');
if(updatebutton){
    updatebutton.forEach((e)=>{
        e.addEventListener('click',
    (e)=>{
        e.preventDefault();
        document.getElementById('editform').action ="/products/"+ e.target.parentElement.parentElement.querySelectorAll('td')[0].children[0].innerHTML;
        document.getElementById('drawer-update-product-default').querySelectorAll('input')[2].value = e.target.parentElement.parentElement.querySelectorAll('td')[1].innerHTML;
        document.getElementById('drawer-update-product-default').querySelectorAll('input')[3].value = e.target.parentElement.parentElement.querySelectorAll('td')[2].innerHTML;
        document.getElementById('drawer-update-product-default').querySelectorAll('input')[5].value = e.target.parentElement.parentElement.querySelectorAll('td')[4].innerHTML.substr(1);
        document.getElementById('drawer-update-product-default').querySelectorAll('input')[6].value = e.target.parentElement.parentElement.querySelectorAll('td')[5].innerHTML;
        if(e.target.parentElement.parentElement.querySelectorAll('td')[6].innerHTML>0){
            document.getElementById('drawer-update-product-default').querySelectorAll('input')[7].checked =true;
        }else{
            document.getElementById('drawer-update-product-default').querySelectorAll('input')[7].checked = false;
        }
        document.getElementById('drawer-update-product-default').querySelectorAll('select')[0].value = e.target.parentElement.parentElement.querySelectorAll('td')[7].innerHTML;
        document.getElementById('drawer-update-product-default').querySelectorAll('textarea')[0].value = e.target.parentElement.parentElement.querySelectorAll('td')[9].innerHTML;
    }
    )
    })
    
}

let updatecatbutton = document.querySelectorAll('#updateCategoryButton');
if(updatecatbutton){
    updatecatbutton.forEach((e)=>{
        e.addEventListener('click',
    (e)=>{
        e.preventDefault();
        document.getElementById('editcategory').action ="/categories/"+ e.target.parentElement.parentElement.querySelectorAll('td')[0].children[0].innerHTML;
        document.getElementById('editcategory').querySelectorAll('input')[2].value = e.target.parentElement.parentElement.querySelectorAll('td')[1].innerHTML;
    }
    )
    })
    
}


let updateuserbutton = document.querySelectorAll('#edituserbutton');
if(updateuserbutton){
    updateuserbutton.forEach((e)=>{
        e.addEventListener('click',
    (e)=>{
        e.preventDefault();
        // console.log(e.target.parentElement.parentElement.querySelectorAll('td')[0].children[0].innerHTML)
        //Form
         document.getElementById('edituserform').action ="/admin/users/"+ e.target.parentElement.parentElement.querySelectorAll('td')[0].children[0].innerHTML;
         //User Id
        document.getElementById('edituserform').querySelectorAll('input')[2].value = e.target.parentElement.parentElement.querySelectorAll('td')[0].children[0].innerHTML;
        //First Name
        document.getElementById('edituserform').querySelectorAll('input')[3].value = e.target.parentElement.parentElement.querySelectorAll('td')[1].children[1].children[0].children[0].innerHTML;
        //Last Name
        document.getElementById('edituserform').querySelectorAll('input')[4].value = e.target.parentElement.parentElement.querySelectorAll('td')[1].children[1].children[0].children[1].innerHTML;
        //Email
        document.getElementById('edituserform').querySelectorAll('input')[5].value = e.target.parentElement.parentElement.querySelectorAll('td')[1].children[1].children[1].innerHTML;
        //Role
        if(e.target.parentElement.parentElement.querySelectorAll('td')[3].innerHTML=='Admin'){
          document.getElementById('edituserform').querySelectorAll('select')[0].value = 1;
        }
        else{
            document.getElementById('edituserform').querySelectorAll('select')[0].value = 0;
        }
        //Status
        if(e.target.parentElement.parentElement.querySelectorAll('td')[5].children[0].children[1].innerHTML=='Activated'){
            document.getElementById('edituserform').querySelectorAll('select')[1].value = 1;
          }
          else{
              document.getElementById('edituserform').querySelectorAll('select')[1].value = 0;
          }

          //Phone Number
          document.getElementById('edituserform').querySelectorAll('input')[7].value = e.target.parentElement.parentElement.querySelectorAll('td')[2].innerHTML;
        

        // document.getElementById('editcategory').querySelectorAll('input')[2].value = e.target.parentElement.parentElement.querySelectorAll('td')[1].innerHTML;
        
    }
    )
    })
    
}
