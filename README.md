<h1>TEYMSAS,</h1>

  <p>Bienvenido a la plataforma de comercio electrónico de <strong>TEYMSAS</strong>. Este sistema permite a los clientes realizar compras y solicitar cotizaciones de materiales y servicios de colocación de techos. La plataforma ha sido diseñada para facilitar el acceso a los productos y servicios de la empresa, garantizando una experiencia de usuario intuitiva y segura.</p>

<h2>Características</h2>
    <ul>
        <li>Catálogo de productos y servicios con detalles específicos de cada uno.</li>
        <li>Funcionalidad de carrito de compras para añadir productos y servicios.</li>
        <li>Opción de compra directa y solicitud de cotizaciones personalizadas.</li>
        <li>Registro y autenticación de usuarios con roles diferenciados para administradores y clientes.</li>
        <li>Ambiente de administración para:
            <ul>
                <li>Gestión de productos y servicios, incluyendo la inserción, modificación y eliminación de elementos.</li>
                <li>Generación de reportes y estadísticas sobre ventas, pedidos y clientes.</li>
                <li>Seguimiento detallado de cada pedido, desde su creación hasta la entrega.</li>
            </ul>
        </li>
        <li>Integración de diversos métodos de pago para la comodidad del cliente.</li>
        <li>Gestión de proveedores y órdenes de compra para mantener el inventario actualizado.</li>
        <li>Evaluación y comentarios de productos por parte de los clientes para mejorar la experiencia del usuario.</li>
    </ul>

  <p>La base de datos de este proyecto está diseñada para gestionar todos los aspectos necesarios de la plataforma de e-commerce de TEYMSAS. Su estructura se encuentra en el archivo <code>e-commerce.sql</code>, que contiene todas las instrucciones SQL necesarias para crear y configurar las tablas siguientes:</p>
    <ul>
        <li><strong>Departamentos y Ciudades:</strong> Manejan la ubicación geográfica de los clientes.</li>
        <li><strong>Usuarios y Clientes:</strong> Almacenan la información de los usuarios del sistema, incluyendo sus datos de contacto y roles.</li>
        <li><strong>Métodos de Pago y Estados de Pedidos:</strong> Permiten gestionar los diferentes métodos de pago y el estado de cada pedido.</li>
        <li><strong>Órdenes de Clientes y Productos:</strong> Administra las órdenes de compra realizadas por los clientes, con detalles de cada producto en las órdenes.</li>
        <li><strong>Entregas y Comentarios de Productos:</strong> Almacenan la información sobre las entregas y las reseñas de productos hechas por los clientes.</li>
        <li><strong>Proveedores y Órdenes de Compra:</strong> Controla las órdenes de compra a proveedores para abastecimiento de inventario.</li>
    </ul>
    <p>Para configurar la base de datos, basta con importar el archivo <code>e-commerce.sql</code> en MySQL, lo que generará automáticamente todas las tablas y relaciones definidas para la gestión del sistema.</p>


  <h2>Cómo usar este proyecto</h2>
    <ol>
        <li>Clonar el repositorio: <code>git clone https://github.com/octavioSosaIae/TEYMSAS2</code></li>
        <li>Configurar la base de datos importando el script SQL proporcionado en el directorio <code>/sql</code>.</li>
        <li>Configurar la conexión a la base de datos en el archivo <code>config.php</code>.</li>
        <li>Iniciar el servidor y acceder a la plataforma a través de un navegador web.</li>
    </ol>

<h2>Tecnologías Utilizadas</h2>
<ul>
    <li><strong>Backend</strong>: PHP</li>
    <li><strong>Frontend</strong>: HTML, CSS, JavaScript</li>
    <li><strong>Base de Datos</strong>: MySQL</li>
</ul>

<h2>Desarrollo</h2>
<p>Este sistema es creado y mantenido por CodeDev Uruguay Solutions.</p>
<p>Su uso es para fines meramente educativos.</p>
<p>@2024</p>
