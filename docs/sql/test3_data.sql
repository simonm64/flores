/*Change Schema*/
USE FLOWERS;

/*Test table*/
INSERT INTO `FLOWERS`.`TESTS`(`VC_NME_TST`) VALUES ('Cuestionario para Niños');
/*DELETE FROM `FLOWERS`.`TESTS` WHERE ID_TST = 3;*/

ALTER TABLE `FLOWERS`.`QUESTIONS` MODIFY VC_CPY_QSTN VARCHAR(500);
/*QUESTIONS table*/

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

/*DELETE FROM `FLOWERS`.`QUESTIONS` WHERE ID_TST = 3;*/

/*OPTIONS table*/

INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Muy identificado',2);
INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Medianamente identificado',1);
INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Poco identificado',0);
INSERT INTO `FLOWERS`.`OPTIONS` (`ID_TST`,`VC_OPTN_TXT`,`I_VAL`) VALUES (3,'Nada identificado',-1);

/*DELETE FROM `FLOWERS`.`OPTIONS` WHERE ID_TST = 3;*/