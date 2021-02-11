
let compromise = document.getElementsByName('compromise')
function compromiseFields(){
    let container = document.getElementsByClassName('compromise-part')
    if(compromise[0].checked){
        for(i=0; i<container.length; i++){
            container[i].style.display = 'block'
        }
        //window.scrollTo(0,window.pageYOffset + 50);
    }
    if(compromise[1].checked){
        for(i=0; i<container.length; i++){
            container[i].style.display = 'none'
        }
    }
}

let ots = document.getElementsByName('ots')
function otsFields(){
    let container = document.getElementsByClassName('ots-part')
    if(ots[0].checked){
        for(i=0; i<container.length; i++){
            container[i].style.display = 'block'
        }
        //window.scrollTo(0,window.pageYOffset + 50);
    }
    if(ots[1].checked){
        for(i=0; i<container.length; i++){
            container[i].style.display = 'none'
        }
    }
}