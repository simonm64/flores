/*Change Schema*/
USE FLOWERS;

/*Test table*/
/*--apply--*/
INSERT INTO `FLOWERS`.`TESTS`(`VC_NME_TST`) VALUES ('Cuestionario para Niños');
/*--revert--
DELETE FROM `FLOWERS`.`TESTS` WHERE ID_TST = 3;
*/

/*QUESTIONS table*/
/*--apply--*/
ALTER TABLE `FLOWERS`.`QUESTIONS` MODIFY VC_CPY_QSTN VARCHAR(500);
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiene miedo a cosas conocidas o que puede expresar qué es: a los niños mayores, a profesores, a los perros. Es muy tímido/a. Se esconde entre mis piernas. ','3','1','20','1');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Duda de su propio juicio. Imita mucho a sus compañeros. Es fácilmente influenciable. ','3','2','5','2');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiene dificultad para aprender. Suele caer en los mismos errores. Tiene enfermedades en las que recaen continuamente. ','3','3','7','3');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está agotado/a tras un gran esfuerzo, tanto mental como físicamente. Se está recuperando de una enfermedad. Le falta energía. No puede ni realizar sus actividades cotidianas., solo quiere dormir. ','3','4','23','4');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('No para de repetir las mismas cosas, se obsesiona con ciertos asuntos o situaciones, Está muy preocupado con algo; exámenes, ir al dentista... Tiene insomnio. ','3','5','35','5');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es muy impaciente. Es muy irritable. Quiere que todo sea rápido si no se aburre o se enfada. Es ansioso/a y nervioso/a. Es inquieto/a para dormir, irritable y da muchas vueltas en la cama. ','3','6','18','6');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está siempre de buen humor aunque yo sepa que le pasa algo negativo. Procura agradar siempre. No les gusta estar solo(a), y busca constantemente compañía para distraerse. Tiende a los excesos, como dedicar mucho tiempo a los video juegos, al chat u otra actividad. ','3','7','1','7');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiene arranques de rabia o celos (de los juguetes, amigos, familia), envidia a otros. Da pellizcos, muerde, pelea, es agresivo(a). ','3','8','15','8');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es demasiado responsable. Se siente abrumado/a por las responsabilidades, en la escuela o en los exámenes. Es muy autoexigente. ','3','9','11','9');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('No tiene confianza en sus capacidades. Teme al fracaso. Es cohibido/a para hablar. Es inseguro/a. Se compara con quien cree que lo hace mejor. ','3','10','19','10');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Ha tenido una situación traumática (accidente, mala noticia, muerte de un ser querido). ','3','11','29','11');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiene una gran demanda de atención. No le gusta la soledad. Es posesivo/a. Le cuesta mucho compartir sus cosas (juguetes...). Interpreta que sus hermanos reciben mas afecto o atención de sus padres que el. Es sobreprotector con sus hermanos menores. ','3','12','8','12');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Se preocupa mucho por los otros, casi más que por el/ella mismo/a. Tiene miedo de accidentes y enfermedades de sus seres queridos. ','3','13','25','13');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Siente miedo a temas intangibles como la oscuridad, nerviosismo sin causa aparente, miedo a algo que no sabe explicar. ','3','14','2','14');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Se da por vencido(a) facilmente. No siente que pueda conseguir lo que se propone. Esta deprimido/a. Gran falta de energía vital. ','3','15','13','15');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está desorientado/a, no sabe qué quiere hacer. Sus intereses cambian continuamente. Está insatisfecho/a. ','3','16','36','16');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es muy egocéntrico(a). Pide y suele hablar sin parar. Es egoísta. Le cuesta mucho escuchar a los demás. No le gusta la soledad. Actividad oral incesante: comer, mascar, chuparse el dedo (niños pequeños), morderse las uñas. ','3','17','14','17');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Se culpa mucho a si mismo/a. Cree que \“todo\” es por su culpa... se disculpa constantemente. Se rasca, o se toca las heridas y las escarban, cualquier forma de autolesionarse. ','3','18','24','18');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está angustiado/a. Llora desesperadamente. Está pasando por una crisis grande. Le falta esperanza. ','3','19','30','19');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es muy rígido/a. Necesita su rutina y no soporta salirse de ella. Tiene una casi excesiva autodisciplina. Es muy perfeccionista. Quiere dar ejemplo a los demás. Físicamente también está rígido/a. ','3','20','27','20');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Quiere dominar. Puede llegar a ser agresivo/a o abusivo/a con otros niños(as). Se montan berrinches fuertes para conseguir lo que quieren. ','3','21','32','21');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es extremadamente pulcro. Le molesta mancharse. Le desagrada mucho jugar con tierra. Necesita tenerlo todo ordenado. ','3','22','10','22');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es un gran luchador/a. Juega hasta caer de cansancio. Trabaja en exceso hasta quedar exhausto. Aun así quiere seguir. No \“sabe\” parar. ','3','23','22','23');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es hiper entusiasta. Tiende a la hiperactividad por sobre entusiasmo. Le cuesta parar de jugar para irse a dormir. Suele ser el/la líder de su clase. ','3','24','31','24');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiene terror o pánico a algo. Tiene pesadillas. Está como \“paralizado\” para algo en concreto. Ha tenido un shock. ','3','25','26','25');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiene muchos berrinches, caprichos, estallidos de mal genio. Pierde el control. Tiene movimientos descontrolados, golpea, arroja objetos. Resulta difícil de controlar. ','3','26','6','26');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es pesimista. Se desanima con mucha facilidad cuando le sale algo mal o no como el/ella quiere (no puede salir con sus amigos, se le rompe un juguete...) ','3','27','12','27');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está aferrado(a) al pasado. Echa mucho de menos algo (antigua casa, colegio) o a alguien que ya no está: abuelos, mascotas, amigos...','3','28','16','28');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está muy apático. Todo le da igual. Está muy aburrido. Habla en voz baja. Tiene movimientos lentos. ','3','29','37','29');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está en un periodo de cambios fuerte; nuevo colegio, principio de guardería, nueva casa, le salen los dientes, empieza a dormir solo...','3','30','33','30');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Le resulta difícil ser tolerante con otros niños. Siempre quiere tener razón. Critica o señala mucho los defectos de los demás. ','3','31','3','31');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está deprimido/a. Está muy triste. Ha estado hospitalizado/a mucho tiempo. Tiene ganas de llorar. Llora. ','3','32','21','32');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('No quiere hacer las cosas \“obligatorias\”, lavarse los dientes, ordenar. Dice estar cansado/a para hacerlas pero si hay algo que le gusta se \“olvida\” de ese cansancio. Le cuesta mucho levantarse por las mañanas. ','3','33','17','33');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Muestra mucho resentimiento hacia padres, amigos… Le echa la culpa a los demás de su infortunio. Hace mucho drama cuando se le regaña. ','3','34','38','34');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Está siempre en las nubes. Es muy soñador/a. Juega con amigos imaginarios. Le cuesta mucho concentrarse. Es muy distraído/a. ','3','35','9','35');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Es indeciso/a. Le cuesta mucho decidirse entre 2 opciones. Tiene altibajos anímicos, pasa de la tristeza a la alegría con mucha facilidad, por ejemplo. ','3','36','28','36');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Tiende a aislarse de los demás. No se suele quejar, se lo \“come\” todo solo. No demuestra bien sus emociones. Necesita estar en su ambiente. ','3','37','34','37');
INSERT INTO QUESTIONS (VC_CPY_QSTN,ID_TST,I_QSTN,ID_PRDCT,I_GRP) VALUES ('Le resulta difícil defenderse por si mismo/a. Les cuesta decir que no. En los juegos suele hacer lo que dice el niño/a más dominante del grupo. No se queja casi nunca. Es muy obediente. ','3','38','4','38');
/*--revert--
DELETE FROM `FLOWERS`.`QUESTIONS` WHERE ID_TST = 3;
*/

/*OPTIONS table*/
/*--apply--*/
INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Muy identificado',2);
INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Medianamente identificado',1);
INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Poco identificado',0);
INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Nada identificado',-1);
/*--revert--
DELETE FROM `FLOWERS`.`OPTIONS` WHERE ID_TST = 3;
*/

/*PRODUCTS TABLE*/
/*--apply--*/
/*ALTER TABLE `FLOWERS`.`PRODUCTS` DROP COLUMN VC_FL_IMG;*/
ALTER TABLE `FLOWERS`.`PRODUCTS` ADD COLUMN ID_TST INT(5);
UPDATE`FLOWERS`.`PRODUCTS` SET ID_TST = 1;
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la ansiedad','Cuando sentimos ansiedad, tortura, desasosiego, pero nos ocultamos tras \"una mascara\" de alegría y despreocupación. Esta flor ayuda a que salgan a la superficie contenidos o traumas profundos que estaban bloqueados, nos ayuda a tomar conciencia de los conflictos y nos da la paz suficiente para superarlos',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el miedo desconocido, intangible','Cuando se tiene una sensación indeterminada de miedo y de peligro el álamo temblón te va a aportar Confianza. Disminuye los miedos y robustece la confianza interior, te da capacidad para valorar de forma realista la propia sensibilidad y mejorarla, manejándola mejor',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la Intolerancia','Cuando sentimos dentro de nosotros una actitud intolerante, tenemos tendencia a la crítica y facilidad para juzgar. Esta flor nos va a ayudar a ser compresivos e indulgentes con los demás. Nos enseña a aceptar los diversos patrones de la conducta humana y a admitir los diferentes caminos de desarrollo individual',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la falta de voluntad y sometimiento','Cuando sentimos que nuestra voluntad es débil y complaciente en grado exagerado hacia los demás. La energía de esta flor nos da una \"inyección de autoestima\", nos aporta fortaleza , y con ella aprendemos a decir \"no\" y a poner límites en función de nuestras posibilidades',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la falta de intuición','Para esos momentos en los que no tenemos confianza en nosotros mismos, desconfiamos de nuestra intuición y buscamos consejo en la opinión de los demás. Nos vemos incapaces de decidir por nosotros mismos. La energía de esta flor nos aporta confianza, seguridad y fe en la propia intuición. Te ayuda a tener opiniones definidas a decidir bien y con rapidez. Te ayuda a asumir la responsabilidad de las propias decisiones aun sabiendo que se pueden cometer errores',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el descontrol','Cuando sentimos miedo a perder el control, perder la razón, miedo a que falle la mente y tener arrebatos temperamentales incontrolables. Esta es \"la flor del autocontrol\", nos ayuda a dejar fluir las emociones dentro de un marco de pensamiento racional. Controlando los propios impulsos. Nos aporta calma y serenidad',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la falta de aprendizaje','Esta flor se relaciona con todo lo que tenga que ver con el aprendizaje, su energía nos ayuda a sacar provecho de nuestra experiencia diaria, nos aumenta la conciencia, la capacidad de observación y reflexión',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el amor condicional','Cuando nos preocupamos demasiado de las necesidades de los demás, con tendencia a cuidar en exceso a los niños, familiares y amigos, corrigiendo en exceso aquello que nos parece mal. Esta flor nos proporciona \"amor incondicional\" nos permite ser compresivos y dejar que nuestros seres queridos sean ellos mismos',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la desconexión, ensoñación','Cuando no podemos centrar la atención, nos fugamos de la realidad. Nuestro romanticismo e idealismo es exagerado hasta el punto de llegar a ser inconscientes. La energía de esta flor nos ayuda a entender que el porvenir depende del interés que pongamos en el presente, nos ayuda a mantener los pies en la tierra, a vivir el aquí y el ahora, conscientes de la realidad y de la belleza y sensibilidad que nos rodea en el momento actual',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la obsesión de limpieza y orden','Cuando tenemos un sentimiento exagerado de perfección, orden, limpieza. Esta flor actúa como una \"agente purificador\", nos ayuda a aceptarnos tal como somos, nos proporciona limpieza anímica, de mente y de cuerpo. Control y limpieza de pensamientos. Restaura el sentido de la proporción y ayuda a establecer prioridades',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el exceso de responsabilidad','Cuando dudas de tus propias  capacidades, te sientes agobiado y desbordado. El Olmo te da capacidad de aguante, calma  y responsabilidad, te ayuda en el orden, planificación y organización de las propias tareas',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el pesimismo','Cuando nos sentimos desanimados, con sensación de fracaso, escépticos, pesimistas. Es una \"depresión reactiva\", por causa conocida\". La energía positiva de la Genciana nos da confianza y fe en el desenlace positivo, nos hace comprender que el crecimiento se logra a través de experiencias y que el fracaso es una oportunidad para aprender. Nos ayuda a no claudicar porque siempre veremos \"la luz en la oscuridad\"',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la desesperanza','Cuando no encontramos razones para seguir adelante, no hay razón de vivir ni nada que te apasione. Estamos resignados y decepcionados. La energía de esta flor nos da \"la chispa inicial\" para luchar en medio de las dificultades, nos da disposición para sondear nuevos caminos a fin de conseguir lo que deseamos, con la esperanza de que todo va a tener un buen desenlace',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el Egocentrismo','Cuando nos sentimos incapaces de estar solos, tenemos una necesidad imperiosa de ser el centro de atención y sin darnos cuenta abrumamos a nuestro entorno. Esta flor nos enseña a escuchar, a pasar del monologo al diálogo, y a vivir con un carácter comunicativo y bondadoso',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para cualquier sentimiento contrario al amor: celos, rabia, envidia, odio...','Cuando tenemos una sensación de hostilidad hacia otra persona, rabia, un rechazo casi hostil. Esta es la flor de la Armonización: "Conexión con los principios más elevados y protección contra influencias negativas, celos, envidia, rabia, etc. Que desconectan a la persona de su alma. Estar en contacto con la energía de esta flor nos hace expresar y generar amor incondicional y somos capaces de desarrollar generosidad, confianza, comprensión y tolerancia con nostros mismos y con los demás. Nos ayuda a vivir en armonia interior e irradiar amor',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la nostalgia','Cuando nos aferramos excesivamente al pasado hasta tal modo que nos impide contactar con el presente y seguir evolucionando. Esta flor nos permite dejar descansar los recuerdos para progresar mentalmente, espiritualmente y disfrutar del presente. Aceptando los cambios del curso de la vida',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el cansancio y la rutina','Cuando te falta la fuerza anímica necesaria para enfrentarte a tu vida cotidiana, esta flor te aporta vitalidad y frescura. Es el remedio del \"lunes por la mañana. La energía de esta flor es como \"una refrescante ducha fría\" que nos da armonía y equilibrio. La cabeza se aclara la percepción se aviva. Es una inyección de ánimo y aliento, particularmente ante todo lo que signifique rutina',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la impaciencia','Cuando nos sentimos acelerados, impacientes, incluso irritables. Esta flor nos aporta paciencia, calma y dulzura. Nos pone freno y relaja la mente nos ayuda a ver con absoluta claridad que todo requiere un tiempo de madurez. Nos permite ser tolerantes y pacientes con aquellas personas que son más lentas',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la falta de confianza en uno mismo','Cuando dudamos de nuestros propios valores y capacidades, tenemos sentimientos de inferioridad y expectativas de fracaso. La energía de esta flor nos aporta mayor confianza y fe en nuestras propias aptitudes, es \"una inyección de auto confianza\". Al fortalecer nuestra autoestima, somos capaces de tomar la iniciativa, asumir riesgos sin temor al fracaso y pasar a la acción, sintiéndonos satisfechos de nosotros mismos',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el miedo conocido, tangible','Cuando tenemos miedo a cosas o situaciones concretas o nos falta valor para emprender determinadas cosas. El mímulo es la flor que nos va a aportar valentía y confianza. Una vez superados los miedos, ideas que te angustian, navegaras por el mundo con jovial despreocupación y disfrutaras de la vida sin temores.\"El miedo es tu gran carcelero, pero la llave es el coraje, si la encuentras serás compasivo y libre\"',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor par la melancolía y depresión','Para cuando estamos expuestos a períodos de melancolía y tristeza, sin causa aparente que lo justifique, incluso puedes llegar a sentirte deprimido. La energía de esta flor te va a aportar felicidad y alegría de vivir. Serenidad, buen humor y estabilidad. Te ayuda a recuperar el contacto contigo mismo, con las verdaderas exigencias, te da equilibrio anímico y mental. Paz interior',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el excesivo sentido del deber','Para cuando tenemos un excesivo sentido del deber. La energía del roble te va ayudar a la moderación. Te va a permitir la entrega pero tomando conciencia de los propios límites. Te permite cuidar de ti mismo sin dejar de lado las responsabilidades. Te ayudará para que aprendas a delegar y aceptar que tu cuerpo y tu mente también necesitan reposo',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el agotamiento','Cuando nos encontramos fatigados mental y físicamente, vacíos de energía. Esta flor nos dará gran fuerza y vitalidad, nos permitirá tomar conciencia de la necesidad de descanso y aprender a reconocer nuestras propias limitaciones, equilibrando entre tensión y descanso',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la culpa','Cuando existe en nosotros una gran \"autoexigencia\", \"autoexigencia\" y sentimiento de culpa. El estado positivo de esta flor nos ayuda a comprender que \"quien retiene sus faltas y no se ama ni se perdona a sí mismo, tampoco puede amar ni perdonar a otros\". Nos ayuda a asumir nuestra responsabilidad con una actitud justa y equilibrada, nos sentimos capaces de perdonar y olvidar',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la preocupación excesiva por los seres queridos','Si nos preocupamos en exceso por los demás, y eso nos hace sentir ansiedad, temor y angustia la energía del castaño rojo nos ayuda a confiar en el destino de los demás, nos ayuda a comprender que las personas a quienes amamos tienen recursos que no imaginamos, nos dará capacidad para mantener la calma mental y física en cualquier situación de emergencia',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el terror y pánico','Para estados de sensación de terror y pánico. En situaciones extremas, casos de emergencia. Cuando nos sentimos angustiados con sensación de parálisis. Esta flor nos da confianza, coraje y determinación ante situaciones límites. Nos aporta tranquilidad, nos ayuda a afrontar las situaciones con calma y valentía, sin perder la cabeza en tiempos de crisis',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la rigidez y exceso de disciplina','Cuando estamos demasiado centrados en el propio perfeccionamiento, somos duros y rígidos con nosotros mismos. Este remedio nos aporta sobre todo flexibilidad física y mental. Nos ayuda a mantenernos flexibles de pensamiento, para que las ideas \"preconcebidas\" no nos priven de la oportunidad de obtener un conocimiento más amplio y más fresco',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la falta de equilibrio','Cuando te resulta difícil mantener tu equilibrio anímico, o incluso dudas entre dos posibles decisiones. Esta es la flor para la elección. Te da seguridad, determinación y te hace capaz de tomar decisiones rápidas convencida de la claridad y seguridad de tus objetivos en la vida',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la falta de consuelo','Cuando aun quedan en nuestro interior secuelas de traumas físicos, mentales o psíquicos, recientes o producidos hace mucho tiempo. Esta flor es la \"gran cicatrizante\" del sistema, neutraliza los acontecimientos causantes del shock y pone en marcha los mecanismos autocurativos del cuerpo. Nos aporta vitalidad y claridad mental para poder asimilar mejor los acontecimientos negativos que se produjeron',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el abatimiento extremo','Cuando nos encontramos en un estado de profunda angustia, al borde de la desesperación. Esta flor nos ayuda a serenar la mente y controlar la afluencia de pensamientos negativos. Se abre en nosotros un espacio para la luz de la esperanza, y se nos brindan nuevos conocimientos que conducen a cambios saludables',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el exceso de entusiasmo y fanatismo','Cuando nos sentimos incapaces de relajarnos, \"hiperactivos\" con tendencia a la dispersión. Esta flor nos advierte la necesidad de darnos cuenta de que las grandes cosas que hay que realizar en la vida deben ser hechas tranquila y moderadamente. Nos ayuda a vencer la tensión y el stress empleando nuestra energía con mejor orientación',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el autoritarismo','Para cuando somos tan perfeccionistas que incluso podemos llegar a ser inflexibles y autoritarios. La energía de esta flor te aporta moderación, te ayuda a afrontar que las cosas que hay que hacer en la vida deben ser hechas tranquilas y moderadamente. Sin tensión ni stress y emplear tu energía con amor y moderación',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la falta de adaptación al cambio','Cuando lo que tenemos es miedo al cambio. Esta flor nos facilita la adaptación, nos protege de la opinión de influencias externas. Te da libertad interior para poder navegar hacia nuevos horizontes. Te aporta iniciativa y valentía para empezar algo nuevo, independencia y protección frente al stress y la inestabilidad interior',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el aislamiento, soberbia','Cuando nos sentimos aislados, distanciados, la energía de esta flor nos ayuda a comprender que la comunicación con los demás es necesaria, nos ayuda a restaurar el equilibrio entre el mundo interno y externo, ampliando la capacidad de comunicación',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para los pensamientos obsesivos','Cuando tenemos pensamientos persistentes, diálogos internos torturantes, nuestro estado mental es \"de disco rayado\". La energía de esta flor nos ayuda a mantener la mente tranquila y en calma, el pensamiento controlado y la cabeza despejada. Nos permite concentrarnos en el presente con mayor claridad de pensamiento',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la insatisfacción','Cuando no sabemos lo que queremos, nuestra vocación es dudosa, nos falta definición y nos dispersamos. Esta flor es como un ancla que nos permite tener los pies en la tierra y tomar decisiones. Nos ayuda a clarificar metas y propósitos en la vida. Es la flor por excelencia del auto conocimiento',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para la apatía','Si nos falta la alegría de vivir, si nos domina la apatía interior, nos resignamos pero sentimos desmotivación y desinterés, la rosa silvestre nos provoca motivación y entusiasmo, nos hace adquirir una actitud constructiva, asumiendo mayor responsabilidad ante la propia vida y uso de su iniciativa para asumir cambios. \"Mueve las fichas, para que los cambios se produzcan\" \"Desde la apatía vives de rodillas. Para vivir hay que ponerse de pie\"',2);
INSERT INTO `FLOWERS`.`PRODUCTS` (`VC_PRDCT_TTL`,`TXT_PRDCT_DSCRPTN`,`ID_TST`) VALUES ('Flor para el resentimiento, amargura y autocompasion','Cuando nos sentimos amargados, \"victimas del destino\" y sin darnos cuenta culpamos a nuestro entorno de todo lo que nos pasa. La energía de la flor de sauce nos ayuda a asumir la responsabilidad sobre nuestra propia vida. A ser positivos, constructivos y optimistas, dejando que afloren a nuestra mente pensamientos positivos',2);

/*---revert--
DELETE FROM `FLOWERS`.`PRODUCTS`WHERE ID_TST = 2;
ALTER TABLE `FLOWERS`.`PRODUCTS` DROP COLUMN ID_TST;
*/