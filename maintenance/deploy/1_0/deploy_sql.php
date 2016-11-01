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
$oDbDeploy->createGroup('tests');
$oDbDeploy->add('apply_ddl', "CREATE TABLE TESTS (
  ID_TST int(5) NOT NULL AUTO_INCREMENT,
  VC_NME_TST varchar(45) NOT NULL,
  PRIMARY KEY (ID_TST, VC_NME_TST)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
");
$oDbDeploy->add('revert_ddl', 'DROP TABLE TESTS;');

$oDbDeploy->add('apply_dml', "INSERT INTO TESTS (VC_NME_TST) VALUES ('Cuestionario Básico');");
$oDbDeploy->add('apply_dml', "INSERT INTO TESTS (VC_NME_TST) VALUES ('Cuestionario Completo');");
$oDbDeploy->add('revert_dml', 'TRUNCATE TABLE TESTS;');


#QUESTIONS table
$oDbDeploy->createGroup('questions');
$oDbDeploy->add('apply_ddl', "CREATE TABLE QUESTIONS (
  ID_QSTN int(5) NOT NULL AUTO_INCREMENT,
  VC_CPY_QSTN varchar(500) DEFAULT NULL,
  ID_TST int(5) NOT NULL DEFAULT 0,
  I_QSTN int(5) NOT NULL DEFAULT 0,
  ID_PRDCT int(5) DEFAULT 0,
  I_GRP int(5) DEFAULT 0,
  PRIMARY KEY (ID_QSTN, ID_TST)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
");
$oDbDeploy->add('revert_ddl', 'DROP TABLE QUESTIONS;');

$aInserts = array(
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tengo miedo a caer enfermo, a la pobreza, a la muerte... o tengo fobias como insectos, muchedumbre...', 1, 1, 20, 1);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Pido consejo y opinión a los demás porque cuestiono mis propias decisiones.', 1, 2, 5, 2);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('No aprendo de mis experiencias, tropiezo una y otra vez con los mismos errores.', 1, 3, 7, 3);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me siento sin energía, no tengo fuerzas ni física ni mental, ni siquiera para salir y distraerme.', 1, 4, 23, 4);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Continuamente estoy dándole vueltas en mi cabeza a muchas cosas, como un disco rayado, muchas veces estos pensamientos no me dejan dormir.', 1, 5, 35, 5);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Quiero que todo se haga enseguida, no soporto la lentitud, me irrita muchísimo, prefiero trabajar sólo/a. Cuando estoy enfermo/a me desespera el no recuperarme rápidamente y me pongo de mal humor.', 1, 6, 18, 6);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cuando me siento mal o enfadado/a pongo una sonrisa y oculto mis problemas, incluso a veces hago reír a los demás.', 1, 7, 1, 7);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cuando alguien me hace algo me gustaría pagarle con la misma moneda. En muchas ocasiones siento celos, envidia, rabia…', 1, 8, 15, 8);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me siento desbordado/a por tantas responsabilidades, es una carga continua, tengo más trabajo del que puedo asumir.', 1, 9, 11, 9);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me falta confianza en mí mismo/a, me siento inferior a otros cuando me comparo, no hago cosas por miedo al fracaso.', 1, 10, 19, 10);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('He vivido situaciones muy traumáticas de las que no he conseguido sobreponerme.', 1, 11, 29, 11);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me siento poco apreciado/a por las personas que quiero, aunque haga mas por ellos que por mí mismo/a.', 1, 12, 8, 12);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me preocupo excesivamente por los demás, sobre todo las personas más cercanas, tengo miedo a que les pase algo, tiendo a sobreproteger a los que más quiero.', 1, 13, 25, 13);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Suelo tener la sensación de que algo malo va a suceder, es un sentimiento de miedo inexplicable, sin causa aparente.', 1, 14, 2, 14);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Creo que las cosas probablemente no tengan solución, a veces me siento como en un túnel sin salida y pienso que nada me puede ayudar.', 1, 15, 13, 15);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Siento que no se qué hacer con mi vida, me siento insatisfecho/a con ella, y no sé qué dirección tomar para cambiar esto.', 1, 16, 36, 16);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Busco la compañía de los demás, no me gusta la soledad, necesito hablar de mis problemas, pero si soy sincero/a apenas atiendo a las dificultades de los otros porque mis propios problemas me absorben totalmente.', 1, 17, 14, 17);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiendo a sentirme culpable en muchas situaciones.', 1, 18, 24, 18);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tengo la sensación de haber llegado al límite de mi resistencia, estoy desesperado/a, ya no sé que hacer, siento que he tocado fondo.', 1, 19, 30, 19);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Soy muy exigente conmigo mismo/a, a veces soy tan rígido/a conmigo que no me permito disfrutar de los pequeños placeres de la vida.', 1, 20, 27, 20);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Siento que siempre tengo razón, me gusta tener el mando y dominar la situación y a los demás.', 1, 21, 32, 21);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('En muchas ocasiones me avergüenzo de mi cuerpo. Me obsesiono con las imperfecciones y olvido lo esencial.', 1, 22, 10, 22);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cumplo con todas mis obligaciones aunque eso me lleve al cansancio extremo, pero nunca me quejo. No puedo permitirme un día de descanso.', 1, 23, 22, 23);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cuando alguien hace algo mal, intento convencerlo para que lo haga como debería de ser. Me frustra que no me hagan caso cuando tengo razón, a menudo esta lucha me deja sin energías', 1, 24, 31, 24);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tengo pesadillas nocturnas, me quedo totalmente parado/a ante unas situación de terror, a veces diría que tengo pánico.', 1, 25, 26, 25);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tengo miedo a perder el control. Me asusta no manejar las situaciones hasta el punto de que a veces pienso que me puedo volver loco.', 1, 26, 6, 26);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me desanimo fácilmente, ante cualquier mínimo obstáculo ya creo que las cosas no van a ir como había pensado, ante las dificultades de la vida me falta perseverancia para conseguir mis metas.', 1, 27, 12, 27);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Recuerdo muchas veces el pasado. Lo que me hacía feliz u oportunidades que he perdido.', 1, 28, 16, 28);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Estoy resignado/a, apático/a con mi vida, me gustaría cambiarla pero eso requiere demasiado esfuerzo y renuncio.', 1, 29, 37, 29);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me influyen muchísimo los cambios (trabajo, pareja, domicilio...). Cuando tengo un objetivo los demás me convencen fácilmente para que cambie de idea.', 1, 30, 33, 30);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me irrita muchísimo los defectos de los demás, juzgo mucho a las personas.', 1, 31, 3, 31);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Muchas veces siento una profunda tristeza y no sé el motivo.', 1, 32, 21, 32);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me siento cansado/a por las mañanas cuando pienso en el día que me espera, aplazo muchas cosas para mañana por el propio cansancio.', 1, 33, 17, 33);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Muchas veces veo el vaso medio vacío, siento que la vida es injusta y sufro las consecuencias de las acciones de otras personas o situaciones ajenas a mi.', 1, 34, 38, 34);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Sueño despierto/a constantemente, suelo estar en mi mundo y cuando me hablan ni me entero que me están hablando.', 1, 35, 9, 35);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me cuesta muchísimo decidirme entre varias cosas o a lo largo del día mi humor varía de la alegría a la tristeza.', 1, 36, 28, 36);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Me gusta distanciarme de los demás y solucionar mis propias dificultades solo/a, los demás a veces piensan que soy orgulloso o excesivamente independiente.', 1, 37, 34, 37);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('No se decir que \"no\", al final acabo haciendo muchas cosas que en el fondo no deseo hacer, incluso renunciando a mis propias necesidades por complacer a los demás.', 1, 38, 4, 38);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tienes temores vagos que no puedes explicar?', 2, 1, 2, 1);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿A menudo te sientes angustiado y ansioso, pero eres incapaz de identificar el problema?', 2, 2, 2, 1);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te levantas con una sensación de aprensión e inquietud y sientes que algo malo puede pasar, pero no sabes qué es?', 2, 3, 2, 1);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tienes temores específicos que puedes identificar y deseas superar?', 2, 4, 20, 2);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres tímido y te asustas con facilidad por circunstancias o cosas particulares?', 2, 5, 20, 2);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cuando te enfrentas con situaciones o cosas que te asustan, ¿te sientes nervioso o demasiado paralizado como para actuar?', 2, 6, 20, 2);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Temes perder el control de tu mente o cuerpo?', 2, 7, 6, 3);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres compulsivo o tienes el impulso de hacer cosas que sabes que son incorrectas porque tienes problemas para controlar tus acciones?', 2, 8, 6, 3);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Temes perder el control y lastimarte a ti mismo u a otras personas?', 2, 9, 6, 3);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te preocupas de la salud y la seguridad de tus amigos y familiares?', 2, 10, 25, 4);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te preocupa que algo pueda pasarle a tus seres queridos?', 2, 11, 25, 4);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tu preocupación excesiva por los demás te ocasiona un estrés considerable?', 2, 12, 25, 4);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sufres de terror extremo?', 2, 13, 26, 5);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tiendes a entrar en pánico y ponerte histérico?', 2, 14, 26, 5);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes perturbado por las pesadillas?', 2, 15, 26, 5);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te falta confianza en tu capacidad para juzgar las cosas por tu cuenta y tomar decisiones?', 2, 16, 5, 6);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te encuentras pidiendo consejos a los demás, incluso cuando sabes lo que quieres?', 2, 17, 5, 6);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Después de recibir los consejos de los demás, ¿te encuentras confundido con las opciones y cambias de dirección constantemente con cada recomendación?', 2, 18, 5, 6);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sufres de indecisión, incertidumbre o vacilación?', 2, 19, 28, 7);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tienes problemas para elegir entre varias opciones?', 2, 20, 28, 7);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Experimentas cambios de humor extremos o tienes problemas para mantener tu equilibrio emocional?', 2, 21, 28, 7);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes insatisfecho con tu papel actual en la vida y sientes que la existencia se te escapa entre tus manos?', 2, 22, 36, 8);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Trataste de tomar varios rumbos en tu vida pero parece que nada te satisface?', 2, 23, 36, 8);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te gustaría encontrar un nuevo estilo de vida o carrera (o cambiar los que ya tienes), pero tienes problemas para decidir lo que debes hacer?', 2, 24, 36, 8);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te falta confianza?', 2, 25, 19, 9);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿No pruebas cosas por temor al fracaso?', 2, 26, 19, 9);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes inferior y crees que los demás son más capaces y cualificados que tú?', 2, 27, 19, 9);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Al despertar te sientes cansado y no quieres levantarte?', 2, 28, 17, 10);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que debes fortalecer una parte tuya antes de empezar el día?', 2, 29, 17, 10);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Descubres que al empezar tus actividades cotidianas olvidas tu cansancio y eres capaz de completar tus tareas?', 2, 30, 17, 10);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres distraído o tu atención deambula fácilmente, lo cual te impide concentrarte?', 2, 31, 9, 11);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tienes poco interés en las circunstancias actuales y a menudo sueñas despierto, deseando estar en otro lugar?', 2, 32, 9, 11);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿A menudo te encuentras tomando siestas en cualquier sitio?', 2, 33, 9, 11);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te encuentras atrapado entre vivir en el presente y recordar las memorias del pasado?', 2, 34, 16, 12);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Hay cosas que te gustaría hacer con tu vida, pero que nunca tuviste la oportunidad de llevar a cabo?', 2, 35, 16, 12);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te encuentras recordando los buenos tiempos del pasado y deseas volver a vivir tu vida?', 2, 36, 16, 12);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes indiferente y apático hacia la vida?', 2, 37, 37, 13);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te resignaste a tus circunstancias actuales y no te esfuerzas demasiado en mejorar las cosas ni alcanzar la alegría?', 2, 38, 37, 13);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que te diste por vencido y no te importa lo que pueda pasar?', 2, 39, 37, 13);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes perturbado por los pensamientos indeseables persistentes?', 2, 40, 35, 14);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te preocupas o tienes discusiones mentales que giran alrededor de tu mente?', 2, 41, 35, 14);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tienes problemas para dormir debido al ruido mental y las preocupaciones?', 2, 42, 35, 14);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Encuentras que eres incapaz de aprender de las experiencias pasadas y repites los mismos errores o patrones de comportamiento?', 2, 43, 7, 15);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que es necesario repasar o corregir las cosas que ya hiciste por la falta de observación?', 2, 44, 7, 15);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Hay alguna situación o condición que se repita constantemente en tu vida y que te gustaría superar?', 2, 45, 7, 15);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Acabas de atravesar o estás superando una enfermedad o un sufrimiento personal que te dejó agotado física o mentalmente?', 2, 46, 23, 16);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te cansas fácilmente y no tienes la energía suficiente para completar tus tareas ni disfrutar el día?', 2, 47, 23, 16);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que te falta la fuerza y la vitalidad, y que incluso puedes quedar agotado luego de hacer un esfuerzo mínimo?', 2, 48, 23, 16);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Las otras personas te encuentran distanciado, orgulloso y a veces condescendiente?', 2, 49, 34, 17);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te gusta estar solo y no deseas interferir ni que los demás interfieran en tus asuntos?', 2, 50, 34, 17);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres autosuficiente y prefieres pasar tu tiempo a solas?', 2, 51, 34, 17);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Encuentras que pierdes la paciencia, te pones tenso e irritable con las personas y las cosas que son demasiado lentas para ti?', 2, 52, 18, 18);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Haces las cosas con prisa y te apresuras entre los lugares o las situaciones?', 2, 53, 18, 18);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Encuentras que necesitas trabajar solo porque los demás no pueden seguir tu ritmo?', 2, 54, 18, 18);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Encuentras que los demás evitan conversar contigo porque tiendes a hablar mucho?', 2, 55, 14, 19);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿No te gusta estar solo y buscas la compañía de cualquier persona que esté dispuesta a escuchar tus problemas?', 2, 56, 14, 19);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes la necesidad de orientar las conversaciones hacia tus intereses o problemas especiales y te rehúsas a detenerte incluso cuando los demás tienen que irse?', 2, 57, 14, 19);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tiendes a ocultar tus dolores o preocupaciones a los demás, haciendo que incluso las circunstancias más difíciles parezcan irrelevantes?', 2, 58, 1, 20);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te esfuerzas demasiado para no cumplir con los deseos de los demás con el fin de evitar discusiones o peleas?', 2, 59, 1, 20);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cuando te sientes preocupado, ¿te encuentras bebiendo alcohol o usando drogas para mantenerte feliz?', 2, 60, 1, 20);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Es fácil que los demás se aprovechen de ti por tu disposición a ayudar a otras personas?', 2, 61, 4, 21);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te es difícil negarte cuando alguien más te pide ayuda y te conviertes en un sirviente en vez de una persona colaboradora?', 2, 62, 4, 21);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Descuidas tus propias necesidades porque te ocupas demasiado de las necesidades de los demás?', 2, 63, 4, 21);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Estás involucrado en una relación o situación de la que te gustaría liberarte, pero de la que no puedes separarte?', 2, 64, 33, 22);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Estás en un estado de transición o cambio?', 2, 65, 33, 22);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('En medio de este cambio, ¿encuentras que tienes problemas para dejar atrás las ataduras del pasado y tener un comienzo nuevo?', 2, 66, 33, 22);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres sospechoso y desconfiado de los motivos e intenciones de otras personas?', 2, 67, 15, 23);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Los demás te encuentran rencoroso, envidioso, celoso o vengativo?', 2, 68, 15, 23);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Encuentras que te falta compasión y afecto hacia los demás?', 2, 69, 15, 23);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Son pocas las ocasiones en las que te sientes satisfecho con tus logros y siempre sientes que lo pudiste haber hecho mejor?', 2, 70, 24, 24);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te culpas a ti mismo por los errores de otras personas y sientes que sus defectos son de cierta manera tu culpa o responsabilidad?', 2, 71, 24, 24);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Hay algo en ti que no acabas de perdonarte? ', 2, 72, 24, 24);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tiene usted más responsabilidades de las que en estos momentos puede soportar?', 2, 73, 11, 25);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te encuentras abrumado por tu trabajo y aunque eres capaz, sientes que te comprometiste a hacer más de lo que en realidad puedes lograr?', 2, 74, 11, 25);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes desanimado cuando te enfrentas con la magnitud de tus responsabilidades?', 2, 75, 11, 25);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Hay traumas o conmociones del pasado de los que posiblemente no te hayas recuperado completamente?', 2, 76, 29, 26);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que una cirugía o un accidente pasados son los responsables de tu condición actual?', 2, 77, 29, 26);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sufriste una pérdida personal que no has podido superar?', 2, 78, 29, 26);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que alcanzaste los límites de tu resistencia y que no hay nada más que enfrentar que la aniquilación?', 2, 79, 30, 27);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sufres de angustia mental y desesperación profunda?', 2, 80, 30, 27);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que el peso de la vida es mayor a lo que puedes soportar?', 2, 81, 30, 27);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Perdiste la esperanza de recuperarte o recibir ayuda para superar una enfermedad o dificultad?', 2, 82, 13, 28);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Crees que es inútil buscar más ayuda para tus problemas?', 2, 83, 13, 28);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Abandonaste las esperanzas de que las cosas mejorarán en una circunstancia o situación de tu vida?', 2, 84, 13, 28);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes triste y deprimido sin razón aparente?', 2, 85, 21, 29);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Esta depresión te envuelve como una nube oscura que oculta las alegrías de la vida?', 2, 86, 21, 29);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que esta tristeza y depresión se van de manera tan repentina como llegan y sin razón aparente?', 2, 87, 21, 29);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te desanimas fácilmente cuando las cosas no salen como quieres?', 2, 88, 12, 30);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cuando te dispones a cumplir una tarea, ¿te sientes demasiado sensible sobre las demoras y obstáculos pequeños, lo cual puede llevarte a dudar sobre ti mismo y en ocasiones provocarte depresión?', 2, 89, 12, 30);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te es difícil empezar de nuevo después de encontrar problemas?', 2, 90, 12, 30);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres de las personas que sigue avanzando incansablemente sin importar las oposiciones ni demoras?', 2, 91, 22, 31);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Las personas siempre pueden confiar en que completarás lo que te propongas, independiente del reto?','2', 92, 22, 31);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tiendes a lanzarte a tus proyectos y descuidar tus necesidades y las de tus seres queridos?', 2, 93, 22, 31);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que la vida ha sido injusta contigo, pero no por tu culpa?', 2, 94, 38, 32);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes resentimiento o amargura hacia las personas que te trataron mal?', 2, 95, 38, 32);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('A pesar de todos tus logros, ¿sientes que en mayor medida no recibes recompensas por tus mejores esfuerzos mientras que otras personas obtienen gratificaciones cuando no lo merecen?', 2, 96, 38, 33);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que hay algo malo en tu apariencia física o hay cosas que te gustaría cambiar de tu aspecto?', 2, 97, 10, 34);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres compulsivo sobre la limpieza, incluso llegando ocasionalmente a puntos extremos?', 2, 98, 10, 34);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que te vas a contaminar (o que ya te contaminaste) y que necesitas limpiarte?', 2, 99, 10, 34);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres posesivo sobre tus seres queridos y crees que conoces lo mejor para ellos, y a menudo los diriges y corriges incluso en los detalles más insignificantes de sus vidas?', 2, 100, 8, 35);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que no recibes el aprecio de las personas que cuidas?', 2, 101, 8, 35);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Necesitas la atención y devoción de las personas que amas, y sientes que es su deber mantener una relación estrecha contigo?', 2, 102, 8, 35);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Cuando evalúas personas y situaciones, ¿buscas las cosas que te parezcan incorrectas?', 2, 103, 3, 36);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te molestan los hábitos pequeños y la idiosincrasia de los demás?', 2, 104, 3, 36);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres crítico e intolerante hacia las personas que no se ajustan a tus estándares o expectativas?', 2, 105, 3, 36);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tienes opiniones firmes y tratas de convencer a los demás de que estás en lo correcto?', 2, 106, 31, 37);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te indignas fácilmente por las injusticias y discutes o defiendes los principios en los que crees?', 2, 107, 31, 37);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Te sientes nervioso o en ocasiones tenso y demasiado entusiasmado, además de siempre enseñar y filosofar?', 2, 108, 31, 37);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que tienes una misión en la vida que debes cumplir?', 2, 109, 27, 38);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres estricto en tu afiliación a una disciplina social o religiosa, o a una manera particular de vivir?', 2, 110, 27, 38);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Sientes que es importante cumplir con tus ideales para convertirte en un ejemplo y hacer que otras personas te sigan?', 2, 111, 27, 38);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Tiendes a tomar el mando en las circunstancias y situaciones en las que te involucras?', 2, 112, 32, 39);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Eres de carácter fuerte y esperas una obediencia total e incondicional de las personas a tu alrededor?', 2, 113, 32, 39);",
	"INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('¿Crees que eres un \"líder nato\"?', 2, 114, 32, 39);",
);
foreach($aInserts as $sInsert){
	$oDbDeploy->add('apply_dml', $sInsert);
}
$oDbDeploy->add('revert_dml', 'TRUNCATE TABLE QUESTIONS;');


#OPTIONS table
$oDbDeploy->createGroup('options');
$oDbDeploy->add('apply_ddl',
	'CREATE TABLE OPTIONS (
		ID_OPTN INT(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
		ID_TST INT(5) DEFAULT 0 NOT NULL,
		VC_OPTN_TXT VARCHAR(45) DEFAULT \'Option with no copy\' NOT NULL,
		I_VAL INT(5) DEFAULT 0
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;'
);
$oDbDeploy->add('revert_ddl', 'DROP TABLE OPTIONS');

$aInserts = array(
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (1,'Si, muy frecuentemente',2);",
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (1,'A veces',1);",
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (1,'Rara vez',0);",
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (1,'Nunca',-1);",
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (2,'Si, muy frecuentemente',4);",
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (2,'A veces',1);",
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (2,'Rara vez',0);",
	"INSERT INTO OPTIONS (ID_TST, VC_OPTN_TXT, I_VAL) VALUES (2,'Nunca',-1);",
);
foreach($aInserts as $sInsert){
	$oDbDeploy->add('apply_dml', $sInsert);
}
$oDbDeploy->add('revert_dml', 'TRUNCATE TABLE OPTIONS');


#PRODUCTS table
$oDbDeploy->createGroup('products');
$oDbDeploy->add('apply_ddl',
	'CREATE TABLE PRODUCTS (
		ID_PRDCT int(5) NOT NULL AUTO_INCREMENT,
		VC_PRDCT_TTL varchar(100) DEFAULT NULL,
		TXT_PRDCT_DSCRPTN text,
		PRIMARY KEY (ID_PRDCT)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;'
);
#VC_FL_IMG varchar(45) DEFAULT NULL,
$oDbDeploy->add('revert_ddl', 'DROP TABLE PRODUCTS;');

$aInserts = array(
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la ansiedad','Cuando sentimos ansiedad, tortura, desasosiego, pero nos ocultamos tras \"una mascara\" de alegría y despreocupación. Esta flor ayuda a que salgan a la superficie contenidos o traumas profundos que estaban bloqueados, nos ayuda a tomar conciencia de los conflictos y nos da la paz suficiente para superarlos');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el miedo desconocido, intangible','Cuando se tiene una sensación indeterminada de miedo y de peligro el álamo temblón te va a aportar Confianza. Disminuye los miedos y robustece la confianza interior, te da capacidad para valorar de forma realista la propia sensibilidad y mejorarla, manejándola mejor');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la Intolerancia','Cuando sentimos dentro de nosotros una actitud intolerante, tenemos tendencia a la crítica y facilidad para juzgar. Esta flor nos va a ayudar a ser compresivos e indulgentes con los demás. Nos enseña a aceptar los diversos patrones de la conducta humana y a admitir los diferentes caminos de desarrollo individual');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de voluntad y sometimiento','Cuando sentimos que nuestra voluntad es débil y complaciente en grado exagerado hacia los demás. La energía de esta flor nos da una \"inyección de autoestima\", nos aporta fortaleza , y con ella aprendemos a decir \"no\" y a poner límites en función de nuestras posibilidades');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de intuición','Para esos momentos en los que no tenemos confianza en nosotros mismos, desconfiamos de nuestra intuición y buscamos consejo en la opinión de los demás. Nos vemos incapaces de decidir por nosotros mismos. La energía de esta flor nos aporta confianza, seguridad y fe en la propia intuición. Te ayuda a tener opiniones definidas a decidir bien y con rapidez. Te ayuda a asumir la responsabilidad de las propias decisiones aun sabiendo que se pueden cometer errores');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el descontrol','Cuando sentimos miedo a perder el control, perder la razón, miedo a que falle la mente y tener arrebatos temperamentales incontrolables. Esta es \"la flor del autocontrol\", nos ayuda a dejar fluir las emociones dentro de un marco de pensamiento racional. Controlando los propios impulsos. Nos aporta calma y serenidad');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de aprendizaje','Esta flor se relaciona con todo lo que tenga que ver con el aprendizaje, su energía nos ayuda a sacar provecho de nuestra experiencia diaria, nos aumenta la conciencia, la capacidad de observación y reflexión');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el amor condicional','Cuando nos preocupamos demasiado de las necesidades de los demás, con tendencia a cuidar en exceso a los niños, familiares y amigos, corrigiendo en exceso aquello que nos parece mal. Esta flor nos proporciona \"amor incondicional\" nos permite ser compresivos y dejar que nuestros seres queridos sean ellos mismos');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la desconexión, ensoñación','Cuando no podemos centrar la atención, nos fugamos de la realidad. Nuestro romanticismo e idealismo es exagerado hasta el punto de llegar a ser inconscientes. La energía de esta flor nos ayuda a entender que el porvenir depende del interés que pongamos en el presente, nos ayuda a mantener los pies en la tierra, a vivir el aquí y el ahora, conscientes de la realidad y de la belleza y sensibilidad que nos rodea en el momento actual');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la obsesión de limpieza y orden','Cuando tenemos un sentimiento exagerado de perfección, orden, limpieza. Esta flor actúa como una \"agente purificador\", nos ayuda a aceptarnos tal como somos, nos proporciona limpieza anímica, de mente y de cuerpo. Control y limpieza de pensamientos. Restaura el sentido de la proporción y ayuda a establecer prioridades');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el exceso de responsabilidad','Cuando dudas de tus propias  capacidades, te sientes agobiado y desbordado. El Olmo te da capacidad de aguante, calma  y responsabilidad, te ayuda en el orden, planificación y organización de las propias tareas');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el pesimismo','Cuando nos sentimos desanimados, con sensación de fracaso, escépticos, pesimistas. Es una \"depresión reactiva\", por causa conocida\". La energía positiva de la Genciana nos da confianza y fe en el desenlace positivo, nos hace comprender que el crecimiento se logra a través de experiencias y que el fracaso es una oportunidad para aprender. Nos ayuda a no claudicar porque siempre veremos \"la luz en la oscuridad\"');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la desesperanza','Cuando no encontramos razones para seguir adelante, no hay razón de vivir ni nada que te apasione. Estamos resignados y decepcionados. La energía de esta flor nos da \"la chispa inicial\" para luchar en medio de las dificultades, nos da disposición para sondear nuevos caminos a fin de conseguir lo que deseamos, con la esperanza de que todo va a tener un buen desenlace');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el Egocentrismo','Cuando nos sentimos incapaces de estar solos, tenemos una necesidad imperiosa de ser el centro de atención y sin darnos cuenta abrumamos a nuestro entorno. Esta flor nos enseña a escuchar, a pasar del monologo al diálogo, y a vivir con un carácter comunicativo y bondadoso');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para cualquier sentimiento contrario al amor: celos, rabia, envidia, odio...','Cuando tenemos una sensación de hostilidad hacia otra persona, rabia, un rechazo casi hostil. Esta es la flor de la Armonización: Conexión con los principios más elevados y protección contra influencias negativas, celos, envidia, rabia, etc. Que desconectan a la persona de su alma. Estar en contacto con la energía de esta flor nos hace expresar y generar amor incondicional y somos capaces de desarrollar generosidad, confianza, comprensión y tolerancia con nostros mismos y con los demás. Nos ayuda a vivir en armonia interior e irradiar amor');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la nostalgia','Cuando nos aferramos excesivamente al pasado hasta tal modo que nos impide contactar con el presente y seguir evolucionando. Esta flor nos permite dejar descansar los recuerdos para progresar mentalmente, espiritualmente y disfrutar del presente. Aceptando los cambios del curso de la vida');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el cansancio y la rutina','Cuando te falta la fuerza anímica necesaria para enfrentarte a tu vida cotidiana, esta flor te aporta vitalidad y frescura. Es el remedio del \"lunes por la mañana. La energía de esta flor es como \"una refrescante ducha fría\" que nos da armonía y equilibrio. La cabeza se aclara la percepción se aviva. Es una inyección de ánimo y aliento, particularmente ante todo lo que signifique rutina');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la impaciencia','Cuando nos sentimos acelerados, impacientes, incluso irritables. Esta flor nos aporta paciencia, calma y dulzura. Nos pone freno y relaja la mente nos ayuda a ver con absoluta claridad que todo requiere un tiempo de madurez. Nos permite ser tolerantes y pacientes con aquellas personas que son más lentas');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de confianza en uno mismo','Cuando dudamos de nuestros propios valores y capacidades, tenemos sentimientos de inferioridad y expectativas de fracaso. La energía de esta flor nos aporta mayor confianza y fe en nuestras propias aptitudes, es \"una inyección de auto confianza\". Al fortalecer nuestra autoestima, somos capaces de tomar la iniciativa, asumir riesgos sin temor al fracaso y pasar a la acción, sintiéndonos satisfechos de nosotros mismos');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el miedo conocido, tangible','Cuando tenemos miedo a cosas o situaciones concretas o nos falta valor para emprender determinadas cosas. El mímulo es la flor que nos va a aportar valentía y confianza. Una vez superados los miedos, ideas que te angustian, navegaras por el mundo con jovial despreocupación y disfrutaras de la vida sin temores.\"El miedo es tu gran carcelero, pero la llave es el coraje, si la encuentras serás compasivo y libre\"');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor par la melancolía y depresión','Para cuando estamos expuestos a períodos de melancolía y tristeza, sin causa aparente que lo justifique, incluso puedes llegar a sentirte deprimido. La energía de esta flor te va a aportar felicidad y alegría de vivir. Serenidad, buen humor y estabilidad. Te ayuda a recuperar el contacto contigo mismo, con las verdaderas exigencias, te da equilibrio anímico y mental. Paz interior');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el excesivo sentido del deber','Para cuando tenemos un excesivo sentido del deber. La energía del roble te va ayudar a la moderación. Te va a permitir la entrega pero tomando conciencia de los propios límites. Te permite cuidar de ti mismo sin dejar de lado las responsabilidades. Te ayudará para que aprendas a delegar y aceptar que tu cuerpo y tu mente también necesitan reposo');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el agotamiento','Cuando nos encontramos fatigados mental y físicamente, vacíos de energía. Esta flor nos dará gran fuerza y vitalidad, nos permitirá tomar conciencia de la necesidad de descanso y aprender a reconocer nuestras propias limitaciones, equilibrando entre tensión y descanso');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la culpa','Cuando existe en nosotros una gran \"autoexigencia\", \"autoexigencia\" y sentimiento de culpa. El estado positivo de esta flor nos ayuda a comprender que \"quien retiene sus faltas y no se ama ni se perdona a sí mismo, tampoco puede amar ni perdonar a otros\". Nos ayuda a asumir nuestra responsabilidad con una actitud justa y equilibrada, nos sentimos capaces de perdonar y olvidar');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la preocupación excesiva por los seres queridos','Si nos preocupamos en exceso por los demás, y eso nos hace sentir ansiedad, temor y angustia la energía del castaño rojo nos ayuda a confiar en el destino de los demás, nos ayuda a comprender que las personas a quienes amamos tienen recursos que no imaginamos, nos dará capacidad para mantener la calma mental y física en cualquier situación de emergencia');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el terror y pánico','Para estados de sensación de terror y pánico. En situaciones extremas, casos de emergencia. Cuando nos sentimos angustiados con sensación de parálisis. Esta flor nos da confianza, coraje y determinación ante situaciones límites. Nos aporta tranquilidad, nos ayuda a afrontar las situaciones con calma y valentía, sin perder la cabeza en tiempos de crisis');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la rigidez y exceso de disciplina','Cuando estamos demasiado centrados en el propio perfeccionamiento, somos duros y rígidos con nosotros mismos. Este remedio nos aporta sobre todo flexibilidad física y mental. Nos ayuda a mantenernos flexibles de pensamiento, para que las ideas \"preconcebidas\" no nos priven de la oportunidad de obtener un conocimiento más amplio y más fresco');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de equilibrio','Cuando te resulta difícil mantener tu equilibrio anímico, o incluso dudas entre dos posibles decisiones. Esta es la flor para la elección. Te da seguridad, determinación y te hace capaz de tomar decisiones rápidas convencida de la claridad y seguridad de tus objetivos en la vida');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de consuelo','Cuando aun quedan en nuestro interior secuelas de traumas físicos, mentales o psíquicos, recientes o producidos hace mucho tiempo. Esta flor es la \"gran cicatrizante\" del sistema, neutraliza los acontecimientos causantes del shock y pone en marcha los mecanismos autocurativos del cuerpo. Nos aporta vitalidad y claridad mental para poder asimilar mejor los acontecimientos negativos que se produjeron');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el abatimiento extremo','Cuando nos encontramos en un estado de profunda angustia, al borde de la desesperación. Esta flor nos ayuda a serenar la mente y controlar la afluencia de pensamientos negativos. Se abre en nosotros un espacio para la luz de la esperanza, y se nos brindan nuevos conocimientos que conducen a cambios saludables');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el exceso de entusiasmo y fanatismo','Cuando nos sentimos incapaces de relajarnos, \"hiperactivos\" con tendencia a la dispersión. Esta flor nos advierte la necesidad de darnos cuenta de que las grandes cosas que hay que realizar en la vida deben ser hechas tranquila y moderadamente. Nos ayuda a vencer la tensión y el stress empleando nuestra energía con mejor orientación');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el autoritarismo','Para cuando somos tan perfeccionistas que incluso podemos llegar a ser inflexibles y autoritarios. La energía de esta flor te aporta moderación, te ayuda a afrontar que las cosas que hay que hacer en la vida deben ser hechas tranquilas y moderadamente. Sin tensión ni stress y emplear tu energía con amor y moderación');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la falta de adaptación al cambio','Cuando lo que tenemos es miedo al cambio. Esta flor nos facilita la adaptación, nos protege de la opinión de influencias externas. Te da libertad interior para poder navegar hacia nuevos horizontes. Te aporta iniciativa y valentía para empezar algo nuevo, independencia y protección frente al stress y la inestabilidad interior');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el aislamiento, soberbia','Cuando nos sentimos aislados, distanciados, la energía de esta flor nos ayuda a comprender que la comunicación con los demás es necesaria, nos ayuda a restaurar el equilibrio entre el mundo interno y externo, ampliando la capacidad de comunicación');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para los pensamientos obsesivos','Cuando tenemos pensamientos persistentes, diálogos internos torturantes, nuestro estado mental es \"de disco rayado\". La energía de esta flor nos ayuda a mantener la mente tranquila y en calma, el pensamiento controlado y la cabeza despejada. Nos permite concentrarnos en el presente con mayor claridad de pensamiento');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la insatisfacción','Cuando no sabemos lo que queremos, nuestra vocación es dudosa, nos falta definición y nos dispersamos. Esta flor es como un ancla que nos permite tener los pies en la tierra y tomar decisiones. Nos ayuda a clarificar metas y propósitos en la vida. Es la flor por excelencia del auto conocimiento');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para la apatía','Si nos falta la alegría de vivir, si nos domina la apatía interior, nos resignamos pero sentimos desmotivación y desinterés, la rosa silvestre nos provoca motivación y entusiasmo, nos hace adquirir una actitud constructiva, asumiendo mayor responsabilidad ante la propia vida y uso de su iniciativa para asumir cambios. \"Mueve las fichas, para que los cambios se produzcan\" \"Desde la apatía vives de rodillas. Para vivir hay que ponerse de pie\"');",
	"INSERT INTO PRODUCTS (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN) VALUES ('Flor para el resentimiento, amargura y autocompasion','Cuando nos sentimos amargados, \"victimas del destino\" y sin darnos cuenta culpamos a nuestro entorno de todo lo que nos pasa. La energía de la flor de sauce nos ayuda a asumir la responsabilidad sobre nuestra propia vida. A ser positivos, constructivos y optimistas, dejando que afloren a nuestra mente pensamientos positivos');",
);
foreach($aInserts as $sInsert){
	$oDbDeploy->add('apply_dml', $sInsert);
}
$oDbDeploy->add('revert_dml', 'TRUNCATE TABLE PRODUCTS');


#PRODUCTS_FRONT
$oDbDeploy->createGroup('products_front');
$oDbDeploy->add('apply_ddl', 
	"CREATE TABLE PRODUCTS_FRONT (
		ID_PRDCT_FRONT int(11) NOT NULL AUTO_INCREMENT,
		VC_PRDCT_TTL varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
		TXT_PRDCT_DSCRPTN text COLLATE utf8_spanish_ci,
		VC_FL_IMG varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
		I_CTGRY int(11) DEFAULT 0,
		PRIMARY KEY (`ID_PRDCT_FRONT`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;"
);
$oDbDeploy->add('revert_ddl', 'DROP TABLE PRODUCTS_FRONT');

$aInserts = array(
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('1. Agrimonia','Para los que ocultan sus temores detrás de una máscara de despreocupación.','/img/thumbnail/agrimonia.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('2. Álamo temblón','Para los que tienen miedo a lo desconocido, o sienten miedo sin motivo aparente.','/img/thumbnail/alamo_temblon.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('3.  Haya','Para los que tienen la necesidad de criticar y juzgar constantemente a los demás.','/img/thumbnail/haya.png',0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('4. Centáurea','Para los que no saben decir “no” y se someten a la voluntad de los demás.','/img/thumbnail/centaurea.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('5. Ceratostigma','Para los que buscan consejo y aprobación constante, porque dudan de sí mismos.','/img/thumbnail/ceratostigma.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('6. Cerasífera','Para las personas que controlan sus sentimientos y tienen miedo a perder el control.','/img/thumbnail/cerasifera.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('7. Brote de Castaño','Para los siempre repiten los mismos errores, porque no aprenden de ellos.','/img/thumbnail/brote_castano.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('8. Achicoria','Para los que se preocupan demasiado por los demás, volviéndose autocompasivos si esta atención no es devuelta.','/img/thumbnail/achicoria.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('9. Clematide','Para los que viven en el futuro, porque el presente no les parece interesante.','/img/thumbnail/clematide.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('10. Manzano silvestre','Para la obsesión por la “limpieza”, tanto a nivel psíquico como físico.','/img/thumbnail/manzano_silvestre.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('11. Olmo','Para las personas abrumadas, porque asumen más trabajo del que pueden manejar.','/img/thumbnail/olmo.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('12. Genciana','Para las personas pesimistas, que dudan de sí mismas y se desaniman fácilmente.','/img/thumbnail/genciana.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('13. Aulaga','Para los que han perdido la esperanza y no tiene ánimos de seguir adelante.','/img/thumbnail/aulaga.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('14. Brezo','Para las personas que están centradas en sí mismas y no saben escuchar.','/img/thumbnail/brezo.png',0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('15. Acebo','Para los que tienden a tener emociones negativas, como: rabia, odio, envidia, celos, etc.','/img/thumbnail/acebo.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('16. Madreselva','Para los que insisten en vivir de recuerdos pasados.','/img/thumbnail/madreselva.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('17. Hojarazo','Para las personas que sienten sin fuerzas para afrontar las actividades del día a día, aunque realmente sí las tienen.','/img/thumbnail/hojarazo.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('18. Impaciencia','Para las personas impacientes, inquietas y que siempre van con prisa.','/img/thumbnail/impaciencia.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('19. Alerce','Para los que no confían en sí mismos y siempre se anticipan al fracaso.','/img/thumbnail/alerce.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('20. Mímulo','Para los miedos de origen conocido.','/img/thumbnail/mimulo.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('21. Mostaza','Para los que sienten una tristeza profunda y repentina, pero desconocen su origen.','/img/thumbnail/mostaza.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('22. Roble','Para las personas que no son capaces de rendirse ni abandonar, aunque estén agotados.','/img/thumbnail/roble.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('23. Oliva','Para los que se sienten agotados, tanto físico como mentalmente.','/img/thumbnail/oliva.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('24. Pino','Para el sentimiento de culpa y no merecimiento.','/img/thumbnail/pino.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('25. Castaño Rojo','Para los que se preocupan excesivamente por los demás.','/img/thumbnail/castano_rojo.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('26. Heliantemo','Para el terror y el pánico desmesurado.','/img/thumbnail/heliantemo.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('27. Agua de Roca','Para las personas que son demasiado duras consigo mismas y desean ser tomadas como ejemplo.','/img/thumbnail/agua_roca.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('28. Escleranto','Para las personas indecisas e inestables anímicamente.','/img/thumbnail/escleranto.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('29. Leche de Gallina','Para los traumas, ya sea actual o del pasado, consciente o inconsciente.','/img/thumbnail/leche_gallina.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('30. Castaño dulce','Para los que se sienten totalmente angustiados y se encuentran ante un colapso total.','/img/thumbnail/castano_dulce.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('31. Verbena','Para las personas excesivamente entusiastas que intentan imponer sus ideales.','/img/thumbnail/verbena.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('32. Vid','Para las personas intolerantes, a las que les gusta dominar y mandar a los demás.','/img/thumbnail/vid.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('33. Nogal','Para los cambios y la protección de influencias externas.','/img/thumbnail/nogal.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('34. Violeta de agua','Para las personas solitarias a las que les cuesta relacionarse con los demás.','/img/thumbnail/violeta_agua.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('35. Castaño de indias','Para las personas que se obsesionan con ciertos pensamientos.','/img/thumbnail/castano_indias.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('36. Avena silvestre','Para las personas desanimadas porque quieren hacer algo en la vida, pero no encuentran su vocación.','/img/thumbnail/avena_silvestre.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('37. Escaramujo','Para las personas apáticas, que toman lo que la vida les trae sin intentar cambiar la situación.','/img/thumbnail/escaramujo.png', 0);",
	"INSERT INTO PRODUCTS_FRONT (VC_PRDCT_TTL,TXT_PRDCT_DSCRPTN,VC_FL_IMG,I_CTGRY) VALUES ('38. Sauce','Para las personas amargadas y resentidas por las adversidades que les ha tocado vivir.','/img/thumbnail/sauce.png', 0);",
);
foreach($aInserts as $sInsert){
	$oDbDeploy->add('apply_dml', $sInsert);
}
$oDbDeploy->add('revert_dml', 'TRUNCATE TABLE PRODUCTS_FRONT');


#USERS table
$oDbDeploy->createGroup('users');
$oDbDeploy->add('apply_ddl', 
	"CREATE TABLE USERS (
		ID_USR int(11) NOT NULL AUTO_INCREMENT,
		VC_EMAIL varchar(200) NOT NULL,
		VC_NAME varchar(200) DEFAULT NULL,
		PRIMARY KEY (ID_USR)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;"
);
$oDbDeploy->add('revert_ddl', 'DROP TABLE USERS');


#USER_RESULTS table
$oDbDeploy->createGroup('user_results');
$oDbDeploy->add('apply_ddl', 
	"CREATE TABLE USER_RESULTS (
		ID_USR_RSLTS int(11) NOT NULL AUTO_INCREMENT,
		ID_USR int(11) DEFAULT NULL,
		ID_TST int(5) DEFAULT NULL,
		I_QSTN int(11) DEFAULT NULL,
		I_GRP int(11) DEFAULT NULL,
		I_VALUE int(5) DEFAULT NULL,
		VC_SESSION_ID varchar(45) DEFAULT NULL,
		DT_ANSWRD datetime DEFAULT NULL,
		PRIMARY KEY (ID_USR_RSLTS)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;"
);
$oDbDeploy->add('apply_ddl', 
	"CREATE trigger answer_record_inserted before insert
			on USER_RESULTS
			for each row
			set new.DT_ANSWRD = now();"
);
$oDbDeploy->add('revert_ddl', 'DROP TRIGGER answer_record_inserted;');
$oDbDeploy->add('revert_ddl', 'DROP TABLE USER_RESULTS');


$oDbDeploy->execute($aOptions);
echo("...Script complete\n");