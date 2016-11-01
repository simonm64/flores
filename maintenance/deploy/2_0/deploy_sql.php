<?php
require realpath(dirname(__FILE__) . '/../../bootstrap.php');
require realpath(dirname(__FILE__) . '/../../classes/db_deploy.php');
$oDbDeploy = new db_deploy();
#var_dump($oDbDeploy);
#var_dump($oDbDeploy->execute("SELECT * FROM USERS LIMIT 1"));
$aOptions = getopt('',array('mode:','group:'));
if(!in_array('mode', array_keys($aOptions))){
	echo("Include the mode to execute --mode\n");
	die(1);
}
if(!in_array('group',array_keys($aOptions))){
	echo("Include the group to execute --group\n");
	die(1);
}

#TESTS table
$oDbDeploy->createGroup("tests");
$oDbDeploy->add('apply_dml', "INSERT INTO TESTS (VC_NME_TST) VALUES ('Cuestionario Niños')");
$oDbDeploy->add('revert_dml', "DELETE FROM TESTS WHERE VC_NME_TST = 'Cuestionario Niños'");
$oDbDeploy->add('revert_dml', "ALTER TABLE TESTS AUTO_INCREMENT = 3;");

#QUESTIONS table
$oDbDeploy->createGroup('questions');
$oDbDeploy->add('apply_ddl', "ALTER TABLE QUESTIONS MODIFY VC_CPY_QSTN VARCHAR(500);");
$aInserts = array(
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Tiene miedo a cosas conocidas o que puede expresar qué es: a los niños mayores, a profesores, a los perros. Es muy tímido/a. Se esconde entre mis piernas.',3,1,58,1);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Duda de su propio juicio. Imita mucho a sus compañeros. Es fácilmente influenciable.',3,2,43,2);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Tiene dificultad para aprender. Suele caer en los mismos errores. Tiene enfermedades en las que recaen continuamente.',3,3,45,3);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está agotado/a tras un gran esfuerzo, tanto mental como físicamente. Se está recuperando de una enfermedad. Le falta energía. No puede ni realizar sus actividades cotidianas., solo quiere dormir.',3,4,61,4);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('No para de repetir las mismas cosas, se obsesiona con ciertos asuntos o situaciones, Está muy preocupado con algo; exámenes, ir al dentista... Tiene insomnio. ',3,5,73,5);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es muy impaciente. Es muy irritable. Quiere que todo sea rápido si no se aburre o se enfada. Es ansioso/a y nervioso/a. Es inquieto/a para dormir, irritable y da muchas vueltas en la cama.',3,6,56,6);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está siempre de buen humor aunque yo sepa que le pasa algo negativo. Procura agradar siempre. No les gusta estar solo(a), y busca constantemente compañía para distraerse. Tiende a los excesos, como dedicar mucho tiempo a los video juegos, al chat u otra actividad. ',3,7,39,7);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Tiene arranques de rabia o celos (de los juguetes, amigos, familia), envidia a otros. Da pellizcos, muerde, pelea, es agresivo(a).',3,8,53,8);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es demasiado responsable. Se siente abrumado/a por las responsabilidades, en la escuela o en los exámenes. Es muy autoexigente. ',3,9,49,9);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('No tiene confianza en sus capacidades. Teme al fracaso. Es cohibido/a para hablar. Es inseguro/a. Se compara con quien cree que lo hace mejor.',3,10,57,10);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Ha tenido una situación traumática (accidente, mala noticia, muerte de un ser querido).',3,11,67,11);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Tiene una gran demanda de atención. No le gusta la soledad. Es posesivo/a. Le cuesta mucho compartir sus cosas (juguetes...). Interpreta que sus hermanos reciben mas afecto o atención de sus padres que el. Es sobreprotector con sus hermanos menores.',3,12,46,12);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Se preocupa mucho por los otros, casi más que por el/ella mismo/a. Tiene miedo de accidentes y enfermedades de sus seres queridos.',3,13,63,13);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Siente miedo a temas intangibles como la oscuridad, nerviosismo sin causa aparente, miedo a algo que no sabe explicar.',3,14,40,14);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Se da por vencido(a) facilmente. No siente que pueda conseguir lo que se propone. Esta deprimido/a. Gran falta de energía vital.',3,15,51,15);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está desorientado/a, no sabe qué quiere hacer. Sus intereses cambian continuamente. Está insatisfecho/a.',3,16,74,16);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es muy egocéntrico(a). Pide y suele hablar sin parar. Es egoísta. Le cuesta mucho escuchar a los demás. No le gusta la soledad. Actividad oral incesante: comer, mascar, chuparse el dedo (niños pequeños), morderse las uñas.',3,17,52,17);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Se culpa mucho a si mismo/a. Cree que “todo” es por su culpa... se disculpa constantemente. Se rasca, o se toca las heridas y las escarban, cualquier forma de autolesionarse.',3,18,62,18);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está angustiado/a. Llora desesperadamente. Está pasando por una crisis grande. Le falta esperanza.',3,19,68,19);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es muy rígido/a. Necesita su rutina y no soporta salirse de ella. Tiene una casi excesiva autodisciplina. Es muy perfeccionista. Quiere dar ejemplo a los demás. Físicamente también está rígido/a.',3,20,65,20);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Quiere dominar. Puede llegar a ser agresivo/a o abusivo/a con otros niños(as). Se montan berrinches fuertes para conseguir lo que quieren. ',3,21,70,21);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es extremadamente pulcro. Le molesta mancharse. Le desagrada mucho jugar con tierra. Necesita tenerlo todo ordenado.',3,22,48,22);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es un gran luchador/a. Juega hasta caer de cansancio. Trabaja en exceso hasta quedar exhausto. Aun así quiere seguir. No “sabe” parar.',3,23,60,23);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es hiper entusiasta. Tiende a la hiperactividad por sobre entusiasmo. Le cuesta parar de jugar para irse a dormir. Suele ser el/la líder de su clase.',3,24,69,24);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Tiene terror o pánico a algo. Tiene pesadillas. Está como “paralizado” para algo en concreto. Ha tenido un shock.',3,25,64,25);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Tiene muchos berrinches, caprichos, estallidos de mal genio. Pierde el control. Tiene movimientos descontrolados, golpea, arroja objetos. Resulta difícil de controlar.',3,26,44,26);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es pesimista. Se desanima con mucha facilidad cuando le sale algo mal o no como el/ella quiere (no puede salir con sus amigos, se le rompe un juguete...)',3,27,50,27);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está aferrado(a) al pasado. Echa mucho de menos algo (antigua casa, colegio) o a alguien que ya no está: abuelos, mascotas, amigos...',3,28,54,28);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está muy apático. Todo le da igual. Está muy aburrido. Habla en voz baja. Tiene movimientos lentos.',3,29,75,29);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está en un periodo de cambios fuerte; nuevo colegio, principio de guardería, nueva casa, le salen los dientes, empieza a dormir solo...',3,30,71,30);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Le resulta difícil ser tolerante con otros niños. Siempre quiere tener razón. Critica o señala mucho los defectos de los demás.',3,31,41,31);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está deprimido/a. Está muy triste. Ha estado hospitalizado/a mucho tiempo. Tiene ganas de llorar. Llora.',3,32,59,32);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('No quiere hacer las cosas “obligatorias”, lavarse los dientes, ordenar. Dice estar cansado/a para hacerlas pero si hay algo que le gusta se “olvida” de ese cansancio. Le cuesta mucho levantarse por las mañanas.',3,33,55,33);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Muestra mucho resentimiento hacia padres, amigos… Le echa la culpa a los demás de su infortunio. Hace mucho drama cuando se le regaña.',3,34,76,34);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Está siempre en las nubes. Es muy soñador/a. Juega con amigos imaginarios. Le cuesta mucho concentrarse. Es muy distraído/a.',3,35,47,35);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Es indeciso/a. Le cuesta mucho decidirse entre 2 opciones. Tiene altibajos anímicos, pasa de la tristeza a la alegría con mucha facilidad, por ejemplo.',3,36,66,36);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Tiende a aislarse de los demás. No se suele quejar, se lo “come” todo solo. No demuestra bien sus emociones. Necesita estar en su ambiente.',3,37,72,37);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN, ID_TST, I_QSTN, ID_PRDCT, I_GRP) VALUES ('Le resulta difícil defenderse por si mismo/a. Les cuesta decir que no. En los juegos suele hacer lo que dice el niño/a más dominante del grupo. No se queja casi nunca. Es muy obediente.',3,38,42,38);",
);
foreach($aInserts as $sInsert){
	$oDbDeploy->add('apply_dml', $sInsert);
}
$oDbDeploy->add('revert_dml', 'DELETE FROM QUESTIONS WHERE ID_TST = 3;');
$oDbDeploy->add('revert_dml', "ALTER TABLE QUESTIONS AUTO_INCREMENT = 152;");


#OPTIONS table
$oDbDeploy->createGroup('options');
$aInserts = array(
	"INSERT INTO OPTIONS (ID_TST,VC_OPTN_TXT,I_VAL) VALUES (3,'Muy identificado',2);",
	"INSERT INTO OPTIONS (ID_TST,VC_OPTN_TXT,I_VAL) VALUES (3,'Medianamente identificado',1);",
	"INSERT INTO OPTIONS (ID_TST,VC_OPTN_TXT,I_VAL) VALUES (3,'Poco identificado',0);",
	"INSERT INTO OPTIONS (ID_TST,VC_OPTN_TXT,I_VAL) VALUES (3,'Nada identificado',-1);",
);
foreach($aInserts as $sInsert){
	$oDbDeploy->add('apply_dml', $sInsert);
}
$oDbDeploy->add('revert_dml', 'DELETE FROM OPTIONS WHERE ID_TST = 3;');
$oDbDeploy->add('revert_dml', "ALTER TABLE OPTIONS AUTO_INCREMENT = 8;");


#PRODUCTS table
$oDbDeploy->createGroup('products');
#$oDbDeploy->add('apply_ddl', 'ALTER TABLE PRODUCTS DROP COLUMN VC_FL_IMG;'); //Doesn't exist anymore.
#$oDbDeploy->add('apply_ddl', 'ALTER TABLE PRODUCTS ADD COLUMN ID_TST INT(5);');
#$oDbDeploy->add('apply_ddl', 'UPDATE PRODUCTS SET ID_TST = 1;');
#$oDbDeploy->add('revert_ddl', 'ALTER TABLE PRODUCTS DROP COLUMN ID_TST;');

$aInserts = array(
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la ansiedad','Para el niño que oculta sus sentimientos tras una fachada risueña y feliz, este continuo estado de ocultación y sobreesfuerzo por agradar acaba con estados ansiosos y tortura interna. Esta flor ayuda a tales niños a liberar su confusión interna, compartirla y dejarla  ir, calma y trae consuelo. Trae paz mental cuando hay problemas para conciliar el sueño.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el miedo desconocido, intangible','Para niños que sienten miedo a cosas desconocidas, temor a la oscuridad, fantasmas, miedos nocturnos, ruidos nocturnos, pesadillas. De acuerdo a la edad normalmente lo dicen claramente, en otras ocasiones no lo saben explicar. Reaccionan con miedo a personas y situaciones nuevas. Esta flor les ayuda a sentirse más seguros canalizando sus miedos y afrontándose a ellos.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la Intolerancia','Para niños que muestran intolerancia: siempre quieren tener la razón, desean todo perfecto. Rechazan lo diferente. Se encuentran intolerantes con otros niños. Señalan mucho en los defectos de los demas. Se puede percatar uno de esta actitud tanto en los juegos, como en el colegio, en lo que implique compartir una actividad social. Esta flor les ayudara a desarrollar la capacidad de comprender a los demás con mayor simpatía.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de voluntad y sometimiento','Para niños que se someten a los demás, deseosos de ser aceptados, suelen ser dominados y a veces maltratados por los demás, de lo que nunca se quejan, mas bien padecen. Tienen dificultad para decir que \"no\" y para defenderse. Sus padres suelen decir que son \"buenos\", que siempre hacen lo que se le dice. Esta flor les ayuda a establecer limites y a hacer respetar esos limites a los demas, a saber decir que no.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de intuición','Para niños que dudan de sus decisiones, preguntones, ávidos por el conocimiento, piden consejo a todos antes de realizar una acción, piden confirmación de sus actos, y le gusta ir a la moda. Busca un modelo de imitación. Esta flor les ayuda a reconocer sus propias ideas, sus propios pensamientos, a confiar en sus creencias sin requerir aprobaciones externas.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el descontrol','Para niños que hacen \"berrinches\", caprichos y pierden el control. Explosividad en sus manifestaciones tanto físicas como verbales. Movimientos descontrolados, golpes, arrojo de objetos. Niños \"incontrolables\". Esta flor les ayuda a deshacerse de esa tensión acumulada y relajarse en situaciones de estrés. Ayuda en casos de micción nocturna acompañado de otras flores.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de aprendizaje','Para niños que caen en el mismo error,  que tienen dificultades para el aprendizaje, o que no aprenden de las experiencias. Enfermedades que recaen una y otra vez. Esta flor les ayuda en el proceso de aprendizaje para no volver a cometer los mismos errores una y otra vez.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el amor condicional','Para niños con gran demanda de atención. Necesidad continua de afecto, no les gusta la soledad, se sienten mal frente a lo que interpreta como un rechazo de sus seres queridos, tiende también a desear cuidar de los demás hermanitos menores o de quien cree que lo necesita. Les cuesta compartir sus cosas, pueden ser posesivos, tener una queja continua de su falta de atención, o bien reaccionar con hipersensibilidad. Esta flor les ayuda a ser más independientes.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la desconexión, ensoñación','Para niños soñadores, tienen problemas para mantenerse despiertos, son distraídos y ausentes, viven en el futuro y la imaginación es lo que los destaca, falta de concentración en la escuela. Poseen gran creatividad artística. También cuando la vida onírica es intensa y se traspola a la realidad. Amigos imaginarios. Esta flor les ayuda a canalizar su imaginación.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la obsesión de limpieza y orden','Para niños con necesidad de ver todo limpio, sensación de estar sucios siempre, quieren cambiarse la ropa cada rato, lavarse las manos, etc. No soportan mancharse, les gusta tenerlo todo ordenado. Niños(as) no le gusta su cuerpo o una parte del mismo. Niños(as) que se sienten \"feos(as)\". Esta flor les ayuda aceptarse tal y como son, evitando ese fanatismo por la limpieza.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el exceso de responsabilidad','Para los niños que tienen muchas responsabilidades y se sienten abrumados por ellas, les cuesta pedir ayuda y quieren hacerlo todo solos, porque creen que lo harán mejor. Este proceso los lleva al cansancio y a un estado de stress.Suelen caracterizarse por una alta competitividad, eficiencia y eficacia. Son autoexigentes. Esta flor les ayuda a manejar la presión. De gran ayuda a niños que van a muchas actividades semanales: ingles, futbol, cocina, arte, etc...');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el pesimismo','Para niños negativos y pesimistas, desánimo rápido frente adversidades, tristeza por motivos anteriores que lo han llevado a este estado, por lo regular el niño no llegue a estar así sin antes haber atravesado un conflicto emocional importante. Esta flor les ayuda a ver las cosas más positivas y a creer en sí mismos. Si está enfermo, para ayudarlo a mantener la fe en su curación.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la desesperanza','Para niños con una desesperanza total, cree que no tiene salida su situación, se encuentra deprimido y desalentado. Con falta de energía vital. Esta flor le ayuda a encontrar esperanza y salir de su resignación.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el Egocentrismo','Para el niño(a) que pide sin parar, necesita hablar todo el tiempo, suelen además ser egoístas. Le cuesta mucho escuchar a los demás, no le gusta la soledad. Actividad oral incesante, comer, mascar, chuparse los dedos, morderse las uñas... Cuando se queda solo sufre mucho, busca continua compañía. Esta flor les ayuda a estar más dispuestos a ayudar y escuchar a los demás.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para cualquier sentimiento contrario al amor: celos, rabia, envidia, odio...','Para niños con arranques de rabia o celos u odio, celos con nuevos hermanos, para niños agresivos o vengativos. Para niños mal humorados. Creencia de que el mundo es hostil con el. Se siente que lo dejan de lado, lo culpan. Esta flor les ayuda a ser más empáticos y positivos en las relaciones con los demás. Útil  en crisis del niño(a) por la separación de los padres.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la nostalgia','Para niños que viven del pasado, en los buenos recuerdos del tiempo atrás, el presente no basta. Echar de menos algo que ya no está, padres, abuelos, mascotas. Esta flor les ayuda a dejar ir el pasado y a aceptar los cambios.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el cansancio y la rutina','Para niños con cansancio, falta de ganas para emprender las tareas escolares, les cuesta mucho levantarse por la mañana, se sienten cansados y aburridos, pero si una actividad les interesa, desaparece por arte de magia esta sensación! Necesita motivación y nuevos proyectos que lo entusiasmen. Esta flor le ayuda a descubrir las ganas de vivir.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la impaciencia','Para la impaciencia e irritabilidad, niños que quieren que todo sea rápido, apuran a todo el mundo y los demás les parecen lentos. Suelen ser ansiosos, inquietos y nerviosos. Esta flor les ayuda a relajarse y ser más pacientes.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de confianza en uno mismo','Para niños que no tienen confianza en sus propias capacidades, porque creen antes de intentarlo que van a perder, retiran antes de comenzar un juego de competición, no se animan a exponerse a situaciones donde quede en evidencia sus capacidades o conocimientos, sentimiento de inferioridad, falta de seguridad, se comprara con quien cree que lo hace mejor que él. Esta flor les ayuda a desarrollar la seguridad en sí mismos y reducir el miedo a equivocarse.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el miedo conocido, tangible','Para niños con miedo a cosas conocidas de la vida cotidiana o bien que puede expresar qué es: por ejemplo, miedo a  insectos, a la soledad, a caerse de la bicicleta... etc. Para los tímidos, niños con risa nerviosa, que se esconden entre las piernas de los padres. Esta flor les ayuda a desarrollar la seguridad en sí mismos y reducir el miedo a equivocarse.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor par la melancolía y depresión','Para niños con depresión y profunda tristeza sin causas conocidas, no es muy habitual en niños, pero sí es posible en casos de conflictos emocionales como abandono o maltratos en la primera infancia. Niños hospitalizados por períodos muy prolongados. Niños expuesto a dolor, pérdida de sus progenitores... Lo ven todo gris.Esta flor les ayuda a superar la tristeza y la depresión.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el excesivo sentido del deber','Para niños que son luchadores frente a las dificultades, juega hasta caer de cansancio. Son buenos compañeros, consejeros, los amiguitos lo buscan porque su presencia inspira confianza. Les cuesta mucho reconocer su cansancio y debilidad cuando ya no pueden más. Esta flor les ayuda a conocer y aceptar sus límites, aceptando ayuda externa en situaciones difíciles.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el agotamiento','Para niños con agotamiento total, tanto mental como físico. Han agotado sus energías después de un gran esfuerzo, atletas, estudiantes, etc., el cansancio es tal que no puede realizar sus actividades cotidianas, quieren dormir mas de lo normal para recuperarse. Esta flor les ayuda a ser más fuertes física y mentalmente.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la culpa','Para el sentimiento de culpa, auto castigo, auto reproche. Para niños que  creen que todo lo malo que sucede es su culpa, si mamá está enferma cree que es culpable, suelen pedir disculpas continuamente por cada cosa que hacen. Se siente mal por haberlo hecho mal... Esta flor ayuda a liberar la conciencia de culpabilidad. Aporta alegría y liviandad. Util en niños que se rascan, se tocan las heridas y las escarban, cualquier forma de autolesionarse.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la preocupación excesiva por los seres queridos','Para niños que temen por el bienestar de sus seres amados (incluido las mascotas), cuando mamá o papá tardan en llegar ya piensan que algo malo les ha sucedido. Miedo a la muerte de los padres. Este temor les genera ansiedad. Esta flor les ayuda a tener las preocupaciones bajo control');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el terror y pánico','Para niños que sufren terror o miedo extremo, cuando una situación ha sido tan traumática y produjo un miedo \"que paraliza\". Funciones físicas que por algún shock se han quedado paralizadas: el habla, un desmayo. Util para todo tipo de parálisis corporales, pérdida de la voz, parálisis. Esta flor les ayuda a tranquilizarse y superar el pánico.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la rigidez y exceso de disciplina','Para niños  con rigidez y ritualización de las costumbres, que nada los quita de su rutina. Para niños con una gran autodisciplina. Niños que creen que dan el ejemplo y que todos los demás deberían hacerlo igual que el. A nivel físico también denota rigidez. Esta flor les ayuda a conocer sus límites y no ponerse bajo tanta presión.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de equilibrio','Para niños con cualquier forma de desequilibrio. Indecisión, dificultad para decidir entre dos cosas, cambios anímicos, de la tristeza a la alegría con mucha facilidad. Cuando la indesición es un motivo de sufrimiento interno. Esta flor les ayuda a estar más seguros al tener que tomar una decisión y permanecer en su tarea.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de consuelo','Para toda clase de shocks, por muerte de un familiar, cualquier tipo de traumas, accidentes, malas noticias. Es como la \"madre\" del sistema floral Bach, es la flor que repara lo roto, que reempalma , calma, reconforta el alma. Muy bueno es su uso y efectivo. Esta flor les ayuda a deshacer los bloqueos mentales provocados por los traumas.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el abatimiento extremo','Para el niño(a) que se angustia frecuentemente. El estado donde se cree que todo va acabar, para niños que lloran desesperados y sin consuelo que les valga. Grandes crisis. Esta flor les ayuda a encontrar esperanza y creer en que las cosas pueden salir bien.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el exceso de entusiasmo y fanatismo','Para los niños fanáticos, híper entusiastas, alma justiciera, trata de convencer a los demás de sus maravillosas ideas, cuando se entusiasma con algo vive para ello. Suelen ser los líderes de la clase. Suelen ser hiperactivos. Esta flor le ayuda a relajarse y equilibrar esa tensión y fervor.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el autoritarismo','Para niños que quieren dominar, quiere mandar algunas veces con mano dura, son buenos organizadores, en los juegos generalmente son quienes los organizan. Suelen abusar de otros niños. Esta flor les ayuda a ser más tolerantes y a sacar las cualidades positivas de su personalidad.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de adaptación al cambio','Para niños que les cuesta adaptarse a los cambios (entrar a una escuela nueva, guardería, dormir solo, pubertad, etc.) esta esencia es de una gran utilidad. Protege al niño de las influencias externas y lo ayuda a mantener su camino. Esta flor les ayuda a sentirse más seguros ante las situaciones cambiantes y a seguir su propio camino.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el aislamiento, soberbia','Para niños que les gusta la soledad, son reservados, a veces arrogantes por sentirse superiores a los demás, a veces le es difícil comunicarse con las otras personas, no demuestra sus emociones generalmente y necesita como el aire sus momentos de privacidad. Esta flor les ayuda a ser más sociables y receptivos.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para los pensamientos obsesivos','.Para la mente como disco rayado, cuando el niño(a) tiene una idea fija puede pasar mucho tiempo pensando en ello sin parar esto les impide concentración. Suelen tener insomnio. Esta flor les ayuda a encontrar paz y tranquilidad.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la insatisfacción','Para niños con cambios continuos de una tarea a otra y no acaba ninguna. Insatisfacción continua. Falta de orientación. Aburrimiento por hacer actividades que no le causan motivación, cambia de ocupación repetidamente. Esta flor aporta claridad, seguridad y orientación.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la apatía','Para niños que todo les da igual, no lucha, no se entrega, no le importa su situación actual, aburrimiento, movimientos lentos, voz baja, es poco frecuente en niños. Esta flor les ayuda a disfrutar y participar activamente en la vida.');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el resentimiento, amargura y autocompasion','Para niños con dificultad para perdonar manteniendo el resentimiento, le echa la culpa a los demás de su infortunio, lamentos continuos, siente que no se merecía ese destino, no perdona ni olvida. La acción del remedio es la de devolver el optimismo y permitir que los pensamientos salgan hacía fuera en vez de hacia adentro, aceptando la responsabilidad de sus actos y aprendiendo en consecuencia a perdonar. Esta flor les ayuda a encontrar la paz interior y a entender que, en parte, también son responsables de sus circunstancias.');",
);
foreach($aInserts as $sInsert){
	$oDbDeploy->add('apply_dml', $sInsert);
}
#$oDbDeploy->add('revert_dml', 'DELETE FROM PRODUCTS WHERE ID_TST = 2;');
$oDbDeploy->add('revert_dml', 'DELETE FROM PRODUCTS WHERE ID_PRDCT > 38;');
$oDbDeploy->add('revert_dml', 'ALTER TABLE PRODUCTS AUTO_INCREMENT = 38;');

$oDbDeploy->execute($aOptions);
echo("...Script complete\n");