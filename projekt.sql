drop database if exists projekt;
create database projekt default character set utf8 default collate utf8_croatian_ci;
use projekt; 

#alter database b13_18858056_projekt charset utf8 
#COLLATE utf8_croatian_ci;


create table operater (
id int not null primary key auto_increment,
username varchar (50) not null,
password char(32) not null,
email varchar(255) not null,
ime	varchar(50)	not null,
prezime	varchar(50)	not null,
prvilogin	datetime,
zadnjilogin	datetime
);

ALTER TABLE operater ADD UNIQUE INDEX index_email (email);

insert into operater(username, password, email, ime, prezime)
values ('amatic',  md5('t'),'amatic@gmail.com', 'Ana', 'Matić'),
('ajokic', md5('t'), 'ajokic@gmail.com', 'Andrea', 'Jokić'),
('bkozar',md5('t'),'bkozar@gmail.com','Branko', 'Kozar'),
('tmagdic',md5('t'),'tmagdic@gmail.com', 'Tea', 'Magdić'),
('akramar',md5('t'),'akramar@gmail.com','Ante', 'Kramar'),
('tkos',md5('t'),'tkos@gmail.com', 'Tin', 'Kos'),
('bdevic',md5('t'),'bdevic@gmail.com', 'Bojan', 'Dević'),
('izilic',md5('t'),'izilic@gmail.com', 'Ivana', 'Zilić'),
('gtakac',md5('t'),'gtakac@gmail.com', 'Goran', 'Takač'),
('lbolic',md5('t'),'lbolic@gmail.com', 'Luka', 'Bolić');

create table kategorija_pp (
id int not null primary key auto_increment,
kategorija_pp varchar (100) not null
);

create table potprojekt (
id int not null primary key auto_increment,
kategorija_pp int not null,
naziv varchar(100) not null,
broj_potprojekta int not null,
datum_p datetime,
datum_k datetime,
sporedni_projektant varchar(100) not null,
opis text,
projekt int not null 
);


alter table potprojekt add foreign key (kategorija_pp) references kategorija_pp(id);


create table projekt (
id int not null primary key auto_increment,
naziv varchar(100) not null,
oznaka_projekta varchar(100) not null,
broj_katastarske_cestice int not null,
tip_gradevine varchar(100),
lokacija varchar(100) not null,
glavni_projektant varchar(100) not null,
datum_p datetime,
datum_k datetime,
iznos_p decimal(18,2),
iznos_z decimal(18,2),
opis text,
operater int not null
);

alter table projekt add foreign key (operater) references operater(id);
alter table potprojekt add foreign key (projekt) references projekt(id);



create table investitor (
id int not null primary key auto_increment,
naziv varchar (100) not null,
oib int(11) not null,
adresa varchar (100) not null
);

create table stavka(
projekt int not null,
investitor int not null
);

alter table stavka add foreign key (projekt) references projekt(id);
alter table stavka add foreign key (investitor) references investitor(id);


insert into investitor(id, naziv, oib, adresa)
values (null, 'Samalmon d.o.o.', '85457896557', 'Kralja Trpimira 2, Varaždin'),
(null, 'MAKART d.o.o.', '97897896557', 'Kačićeva 55, Vinkovci'),
(null, 'Vibrobeton d.o.o.', '47897896557', 'Vinkovačka ulica 13, Osijek'),
(null, 'Nexe group', '37897896557', 'Ivana Gorana Kovačića 25, Našice'),
(null, 'Mirko Mirić', '67897896557', 'A.G.Matoša 13, Beli Manstir'),
(null, 'Spačva d.d..', '57897896557', 'Lapovačka 70, Našice'),
(null, 'Amis d.o.o.', '77897896557', 'Vinkovačka ulica 13, Osijek'),
(null, 'Valliant group', '25669789655', 'Duga ulica 25, Osijek'),
(null, 'Mirko Mirić', '67897896557', 'A.G.Matoša 23, Beli Manstir'),
(null, 'Spačva d.d..', '57897896557', 'Lapovačka 71, Našice');


insert into projekt (id, naziv, oznaka_projekta, broj_katastarske_cestice, tip_gradevine, lokacija, glavni_projektant, datum_p, datum_k, iznos_p, iznos_z, opis, operater)
values (null, 'Obnova VG-272', 'GKO-27797', 78946, 'poslovna zgrada', 'Kačićeva 55, Vinkovci', 'Tin Barić', '2015-05-06', '2016-07-06', 78900, 98000, 'Fusce placerat, diam sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 1 ),
(null, 'Obnova VG-576', 'ZGO-35797', 48946, 'stambena zgrada', 'A.G.Matoša 13, Beli Manstir', 'Stjepan Raguž', '2015-12-06', '2016-07-06',589000, 615000,'Suspendisse aliquet, diam sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 2 ),
(null, 'Izgradnja ZG-273', 'GKO-47797', 38946, 'poslovna zgrada', 'Lapovačka 70, Našice', 'Tin Barić', '2014-07-25', '2016-07-06', 338900, 479000, 'Aliquam erat volutpat. Fusce placerat, diam sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 3 ),
(null, 'Obnova VG-577', 'ZGO-35797', 28946, 'industrijski prostor', 'Kralja Trpimira 2, Varaždin', 'Stjepan Raguž', '2015-10-11','2016-07-06', 58900, 78000, 'Lorem ipsum dolor sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 4 ),
(null, 'Obnova VG-274', 'ZKO-27797', 58946, 'poslovna zgrada', 'Vinkovačka ulica 13, Osijek', 'Tin Barić', '2015-05-06','2016-07-06', 65700, 93800,'Fusce placerat, diam sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 5 ),
(null, 'Obnova VG-578', 'ZGO-77797', 68946, 'stambena zgrada', 'A.G.Matoša 13, Beli Manstir', 'Stjepan Raguž', '2015-12-06','2016-07-06', 28900, 68000,'Suspendisse aliquet, diam sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 6 ),
(null, 'Nadogradnja NG-275', 'GKO-27797', 88946, 'poslovna zgrada', 'Duga ulica 25, Osijek', 'Tin Barić', '2014-07-25','2016-07-06', 28900, 38020,'At vero eos et accusamus et iusto. Aliquam erat volutpat. Fusce placerat, diam sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 7 ),
(null, 'Obnova VG-579', 'ZGO-85797', 98946, 'industrijski prostor', 'Duga ulica 110, Varaždin', 'Stjepan Raguž', '2015-10-11','2016-07-06', 48900, 58000, 'Lorem ipsum dolor sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 8 ),
(null, 'Nadogradnja NG-276', 'GKO-87797', 18946, 'poslovna zgrada', 'Lapovačka 70, Našice', 'Tin Barić', '2014-07-25', '2016-07-06', 78900, 98000,'Aliquam erat volutpat. Fusce placerat, diam sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 9 ),
(null, 'Izgradnja ZG-278', 'ZGO-95797', 68946, 'industrijski prostor', 'Ivana Gorana Kovačića 25, Našice', 'Stjepan Raguž', '2015-10-11', '2016-07-06', 58900, 79800,  'Suspendisse aliquet, nunc quis suscipit porttitor. Lorem ipsum dolor sit amet dapibus molestie, erat est fermentum eros, at pellentesque ipsum dui auctor lectus. Curabitur tempor efficitur lorem a bibendum. Praesent consequat quis elit eget aliquet. Maecenas sodales sapien vel sapien varius consectetur. Etiam pellentesque nibh sed nisi dapibus semper eu nec diam. Nullam sit amet massa at diam egestas accumsan vitae vel turpis. Pellentesque neque augue, feugiat vitae maximus ut, volutpat id odio. Praesent ultrices facilisis orci, a pulvinar mi ultrices non. Sed vestibulum leo nec augue vulputate laoreet. Quisque rhoncus ante in enim mattis bibendum. Nunc sagittis urna non eros dignissim interdum. Pellentesque condimentum commodo risus vel venenatis. Vivamus mattis mauris nec nisl condimentum, non aliquet orci viverra. In dignissim urna in urna auctor placerat.', 10 );


insert into stavka (projekt, investitor)
values (1,2),
(3,4),
(4,10),
(5,8),
(6,3),
(2,7),
(8,5),
(9,6),
(7,9),
(10,1);

insert into kategorija_pp (id, kategorija_pp)
values (null, 'arhitektonski projekt'),
(null, 'projekt energetske učinovitosti'),
(null, 'projekt instalacije')
;

insert into potprojekt (id, kategorija_pp, naziv, broj_potprojekta, datum_p, datum_k, sporedni_projektant, opis, projekt)
values (null, 1, 'Potprojekt 1', 2557, '2013-07-29', '2016-07-06', 'Mirko Mirić', 'Aliquam erat volutpat. Nulla a tincidunt arcu. Suspendisse sed interdum tellus, a facilisis sem. In sodales ligula sit amet felis volutpat placerat. Morbi mattis odio nisi, a lacinia leo vestibulum sed. Vivamus eleifend, orci eget semper luctus, nibh velit fermentum mi, sed tempor nisl urna ut nisi. Cras sapien enim, semper condimentum ultrices pellentesque, tincidunt ut leo. Suspendisse finibus bibendum posuere. Aliquam urna nisl, fermentum sit amet lorem at, faucibus tempor magna. Donec facilisis sollicitudin massa ac convallis. Nulla tincidunt luctus mauris, nec consectetur orci. Duis at arcu vel neque gravida efficitur ac sit amet dolor. Curabitur interdum velit euismod eros tincidunt, sed rutrum mauris laoreet. Morbi at justo ut nisl aliquam elementum eget at justo.', 1),
(null, 2,  'Potprojekt 2', 2558, '2015-03-02', '2016-07-06', 'Marina Kos', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2),
(null, 3, 'potprojekt 3', 2559,'2015-05-21',  '2016-07-06','Davor Lučić', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dictum odio eros, sit amet venenatis massa efficitur eu. Nam sollicitudin odio quis ligula blandit, at tristique nulla finibus. Sed urna nulla, pharetra facilisis tortor nec, ultrices bibendum est. In tristique vitae purus eget tempor. Vestibulum facilisis sit amet nibh at posuere. Etiam ut aliquam nisl. Ut eget turpis sed ante vehicula iaculis a in quam. In at vehicula velit, sit amet porttitor eros. Nunc eu erat finibus, rutrum massa in, feugiat arcu. Pellentesque vitae sem ultricies, vehicula nisl eleifend, ultrices augue.', 1 ),
(null, 2, 'Potprojekt 4', 2560, '2016-03-09', '2016-07-06', 'Luka Babić', 'Suspendisse aliquet, nunc quis suscipit porttitor, risus sapien vulputate leo, a sagittis metus eros quis sem. Curabitur augue quam, convallis sed velit a, commodo ullamcorper odio. Nam viverra est sit amet nulla semper, eu maximus ligula rhoncus. Etiam fringilla lectus eu lacus feugiat semper. Sed lacinia massa et lectus convallis ultrices. Maecenas sed sem nisl. Proin et congue est, ultricies dapibus mauris. Aliquam scelerisque, purus vel ornare ornare, odio dolor venenatis dolor, sed sodales ante augue et leo. Donec cursus sollicitudin dui, quis convallis tellus efficitur eu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras elementum, mauris et finibus lacinia, ex ipsum imperdiet erat, nec malesuada enim elit sed tellus. Fusce gravida ut leo sit amet mollis.',  3),
(null,  1, 'Potprojekt 5', 2561, '2015-03-02','2016-07-06', 'Tihomir Bos', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 4),
(null, 3, 'potprojekt 6', 2562,'2015-05-21','2016-07-06', 'Davor Lučić', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dictum odio eros, sit amet venenatis massa efficitur eu. Nam sollicitudin odio quis ligula blandit, at tristique nulla finibus. Sed urna nulla, pharetra facilisis tortor nec, ultrices bibendum est. In tristique vitae purus eget tempor. Vestibulum facilisis sit amet nibh at posuere. Etiam ut aliquam nisl. Ut eget turpis sed ante vehicula iaculis a in quam. In at vehicula velit, sit amet porttitor eros. Nunc eu erat finibus, rutrum massa in, feugiat arcu. Pellentesque vitae sem ultricies, vehicula nisl eleifend, ultrices augue.', 5 ),
(null, 2, 'Potprojekt 7', 2563, '2015-03-02','2016-07-06', 'Mirko  Helner', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 7),
(null, 2, 'potprojekt 8', 2564,'2015-05-21','2016-07-06', 'Sanja Matanović', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dictum odio eros, sit amet venenatis massa efficitur eu. Nam sollicitudin odio quis ligula blandit, at tristique nulla finibus. Sed urna nulla, pharetra facilisis tortor nec, ultrices bibendum est. In tristique vitae purus eget tempor. Vestibulum facilisis sit amet nibh at posuere. Etiam ut aliquam nisl. Ut eget turpis sed ante vehicula iaculis a in quam. In at vehicula velit, sit amet porttitor eros. Nunc eu erat finibus, rutrum massa in, feugiat arcu. Pellentesque vitae sem ultricies, vehicula nisl eleifend, ultrices augue.', 6 ),
(null,  1,'potprojekt 9', 2565,'2015-05-21','2016-07-06', 'Dražen Delić', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dictum odio eros, sit amet venenatis massa efficitur eu. Nam sollicitudin odio quis ligula blandit, at tristique nulla finibus. Sed urna nulla, pharetra facilisis tortor nec, ultrices bibendum est. In tristique vitae purus eget tempor. Vestibulum facilisis sit amet nibh at posuere. Etiam ut aliquam nisl. Ut eget turpis sed ante vehicula iaculis a in quam. In at vehicula velit, sit amet porttitor eros. Nunc eu erat finibus, rutrum massa in, feugiat arcu. Pellentesque vitae sem ultricies, vehicula nisl eleifend, ultrices augue.', 1 ),
(null, 3, 'Potprojekt 10', 2566, '2016-03-09','2016-07-06', 'Tea Babić', 'Suspendisse aliquet, nunc quis suscipit porttitor, risus sapien vulputate leo, a sagittis metus eros quis sem. Curabitur augue quam, convallis sed velit a, commodo ullamcorper odio. Nam viverra est sit amet nulla semper, eu maximus ligula rhoncus. Etiam fringilla lectus eu lacus feugiat semper. Sed lacinia massa et lectus convallis ultrices. Maecenas sed sem nisl. Proin et congue est, ultricies dapibus mauris. Aliquam scelerisque, purus vel ornare ornare, odio dolor venenatis dolor, sed sodales ante augue et leo. Donec cursus sollicitudin dui, quis convallis tellus efficitur eu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras elementum, mauris et finibus lacinia, ex ipsum imperdiet erat, nec malesuada enim elit sed tellus. Fusce gravida ut leo sit amet mollis.',  3)
;



