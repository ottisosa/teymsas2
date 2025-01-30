import customersDAO from "./DAO/customersDAO.js";

window.onload = () => {
    changeForms();
    cargarCiudades();
    let formRegister = document.querySelector("#formLoginRegistro");

    formRegister.onsubmit = async (e) => {
        e.preventDefault();

        let password = document.querySelector("#password");
        let passwordConfirm = document.querySelector("#password_confirm");

        if (password.value === passwordConfirm.value) {
            let RegisterFormData = new FormData(formRegister);

        let complete_name_user = document.querySelector("#full_name");
        let phone_user = document.querySelector("#phone");
        let email_user = document.querySelector("#email");
        let password_user = document.querySelector("#password");
        let document_customer = document.querySelector("#documento");
        let address_customer = document.querySelector("#domicilo");
        let business_name_customer = document.querySelector("#razon_social");
        let rut_customer = document.querySelector("#rut");
        let id_city = document.querySelector("#ciudad");

        const response = await new customersDAO().createCustomer(complete_name_user,phone_user,email_user,password_user,document_customer, address_customer, business_name_customer,rut_customer, id_city);
        
            alert(response.message);
            formRegister.reset();
        } else {
            alert("Las contraseñas no coinciden");
        }
 
}
            // funcion para cambiar el formulario
function changeForms() {
    let btnLogin = document.querySelector("#botonlogin");
    let botonregistro = document.querySelector("#botonregistrarse");
    let panelvista = document.querySelector("#contenedorformulario");

    btnLogin.onclick = () => {
        panelvista.style.left = "0px";
    }
    botonregistro.onclick = () => {
        panelvista.style.left = "-400px";
    }
}
           
   //funcion de login 
    let formLogin = document.querySelector("#formLogin");

    formLogin.onsubmit = async (e) => {
        e.preventDefault();

        let emailLogin = document.querySelector("#emailLogin");
        let passwordLogin = document.querySelector("#passwordLogin");
        let LoginFormData = new FormData();

        LoginFormData.append("email", emailLogin.value);
        LoginFormData.append("password", passwordLogin.value);

        let url = 'http://localhost/teymsas2/app/api/controllers/UserController.php?function=login';

        let config = {
            method: 'POST',
            body: LoginFormData
        };

        let respuesta = await fetch(url, config);
        let datos = await respuesta.json();

        if(datos.success){
            alert("Vuebvebudi")
            location.href ="http://http://localhost/teymsas2/public/user/";
        } else{
            alert(datos.error)
        }

    };
}

            // Definimos los departamentos y sus ciudades
    let departamentos = {
        //"Artigas": ["Artigas", "Bella Unión", "Tomás Gomensoro"],
        //"Canelones": ["Canelones", "La Paz", "Progreso", "Pando"],
        //"Cerro Largo": ["Melo", "Batoví", "Tacuarembó"],
        "Colonia": ["Colonia del Sacramento", "Carmelo", "Juan Lacaze", "Nueva Helvecia","Valdense","Rosario","Tarariras"],
        //"Durazno": ["Durazno", "Villa del Carmen", "La Paloma"],
       // "Flores": ["Trinidad", "Isla Manga", "La Tablada"],
        //"Florida": ["Florida", "Sarandí Grande", "Fray Marcos"],
        //"Lavalleja": [" Minas", "Solís de Mataojo", "José Pedro Varela"],
        "Maldonado": ["Maldonado", "Punta del Este", "San Carlos", "La Barra"],
        "Montevideo": ["Montevideo"],
        //"Paysandú": ["Paysandú", "Quebracho", "Guichón"],
        //"Rio Negro": ["Fray Bentos", "Young", "Nuevo Berlín"],
        //"Rivera": ["Rivera", "Tranqueras", "Vichadero"],
        //"Rocha": ["Rocha", "Castillos", "Chuy", "La Paloma"],
        //"Salto": ["Salto", "Concordia", "San Antonio"],
        "San José": ["San José de Mayo", "Ciudad del Plata", "Libertad"],
        //"Soriano": ["Mercedes", "Dolores", "Palmar"],
        //"Tacuarembó": ["Tacuarembó", "San Gregorio", "San Javier"],
        //"Treinta y Tres": ["Treinta y Tres", "Castillos", "María Albina"]
    };
    

        // Función que se ejecuta al seleccionar un departamento
    function cargarCiudades() {
        let departamentoSeleccionado = document.querySelector("#departamento");
        let ciudadSelect = document.querySelector("#ciudad");
        let nombresDepartamentos = Object.keys(departamentos);
        departamentoSeleccionado.innerHTML +=`
        <option value = ""></option>`;
        nombresDepartamentos.forEach((nombreDepartamento)=>{
            departamentoSeleccionado.innerHTML +=`
                <option value = "${nombreDepartamento}">${nombreDepartamento}</option>
            `;
        });

        departamentoSeleccionado.onchange = ()=>{
            let nombreSelecionado = departamentoSeleccionado.value;
            console.log(departamentos);
            ciudades = departamentos[nombreSelecionado];
            console.log(ciudades);
            ciudadSelect.innerHTML ="";
            ciudades.forEach((ciudad)=>{
                ciudadSelect.innerHTML +=`
                    <option value = "${ciudad}">${ciudad}</option>
                `;
            });
            console.log(nombreSelecionado);
        }
        console.log(nombresDepartamentos);

        
    }   