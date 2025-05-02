
function descargarArchivo (nombre,extension,base64) {
    let linkSource    = `data:application/${extension};base64,${base64}`;

    let downloadLink  = document.createElement("a");
    let fileName      = nombre;
    downloadLink.href = linkSource;
    downloadLink.download = fileName;
    downloadLink.click();
  }

  function formatBytes(bytes) {
    if (bytes === 0) return '0 Byte';
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
  }

  function formatTime(seconds) {
    if (seconds === 0) return '0 sec';

    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);  // Asegura que los segundos sean enteros

    let result = [];

    if (minutes > 0) {
      result.push(`${minutes} min`);
    }

    if (remainingSeconds > 0 || minutes === 0) {  // Asegura que "0 sec" aparezca si no hay minutos
      result.push(`${remainingSeconds} sec`);
    }

    return result.join(' ');
  }


  cargarSelectSyncfusion = (
    id,
    changeFn = () => {},
    enabled = true,
    height = "300px",
    placeholder = "Selecciona una opción",
    index = null
  ) => {
    selectObj = new ej.dropdowns.DropDownList({
      enabled: enabled,
      // Propiedad para cargar opcion por defecto
      index: index,
      // Propiedad para cargar placeholder
      placeholder: placeholder,
      // Propiedad para cargar la altura del popup del select
      popupHeight: height,
      // Propiedad para definir funcion callback del evento 'change'
      change: changeFn,
    });

    // Se carga select a traves de su id
    selectObj.appendTo("#" + id);

    return selectObj;
  };

  // Metodo para cargar select a partir del componente dropdown de syncfusion
  refreshSelectSyncfusion = (selectObj, id, name) => {
    selectObj.refresh();
    selectObj.text = null;
    document.getElementById(id + '_hidden').name = name;
  };

  const mayusculas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
    'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
  ];

  const minusculas = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
    'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
  ];

  const numeros = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

  const especiales = [ '!', '.'];
  function generarPassword(caracteres, contraseniaLongitud) {
    function getRandomInt(max) {
      return Math.floor(Math.random() * max);
    }
    var password = "";
    for (var i = 0; i < contraseniaLongitud; i++) {
      var caracter = getRandomInt(caracteres.length - 1)
      password = password + caracteres[caracter];
    }
    return password;
  }

  function generarPasswordSegura(contraseniaLongitud) {
    if (contraseniaLongitud < 4) {
      contraseniaLongitud = 4;
    }

    const allCharacters = [...mayusculas, ...minusculas, ...numeros, ...especiales];

    function getRandomInt(max) {
      return Math.floor(Math.random() * max);
    }

    // Generar una contraseña inicial con al menos un carácter de cada tipo
    let password = '';
    password += mayusculas[getRandomInt(mayusculas.length)];
    password += minusculas[getRandomInt(minusculas.length)];
    password += numeros[getRandomInt(numeros.length)];
    password += especiales[getRandomInt(especiales.length)];

    // Llenar el resto de la longitud de la contraseña con caracteres aleatorios
    for (let i = 4; i < contraseniaLongitud; i++) {
      const caracter = getRandomInt(allCharacters.length);
      password += allCharacters[caracter];
    }

    // Mezclar los caracteres para que no sigan un patrón predecible
    password = password.split('').sort(() => 0.5 - Math.random()).join('');

    return password;
  }

  function soloNumeros(event) {
    // Elimina cualquier carácter que no sea un número
    const valorSoloNumeros = event.target.value.replace(/[^0-9]/g, '');
    return valorSoloNumeros;
  }

  const inputNumber = (e) => {
    if((parseInt(e.key) || parseInt(e.key) === 0 || e.keyCode === 8
        || e.keyCode === 9  ||  e.keyCode === 39 || e.keyCode === 37
        || e.keyCode === 38 || e.keyCode === 40 || e.keyCode === 13
        || e.charCode === 8 || e.charCode === 9 || e.charCode === 39
        || e.charCode === 37 || e.charCode === 38 || e.charCode === 40
        || e.charCode === 13 ) && e.key !== "'") {
        return true;
    }else{
        e.preventDefault();
        return false;
    }
  };

  function fechaZohaH(fechaLocalEnUTC, zonaHoraria) {
    // Agregamos 'Z' al final de la fecha para que JavaScript lo interprete como UTC
    const fechaUTC = new Date(fechaLocalEnUTC + 'Z');

    // Utilizamos Intl.DateTimeFormat para convertir la fecha a la zona horaria proporcionada
    const opciones = {
        timeZone: zonaHoraria,
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    };

    // Formateamos la fecha según la zona horaria proporcionada
    const formateadorFecha = new Intl.DateTimeFormat('es-ES', opciones);
    const fechaConvertida = formateadorFecha.format(fechaUTC);

    return fechaConvertida;
  }

  const noSpaces = (e) => {
    if (e.key === " ") {
      e.preventDefault();
      return false;
    }
    return true;
  };