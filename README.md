# ReinoPlantae

TCC Oferecido a Universidade de Mogi das Cruzes - Análise e denvolvimento de sistemas.

Sistema Repositorio de plantas medicinais.

## Demo

**[View a external website ](http://ulissesreis.net/plantae/)**

## Implementation

PHP 7.0

MYSQL 5.6.35

JavaScript

### Dependencies

AngularJs 1.6.8

Bootstrap 4.0

FontAwesome 5.1.0

### Installation

Banco de dados:
1. Necessario base de dados Mysql
2. Rodar os scripts de PlantasDDL.sql em seguida PlantasDML.sql que estao no diretorio Scripts Mysql

Aplicação:
1. Alterar o arquivo de conexao de banco de dados com os dados de conexao: ./api/includes/conecta.php
2. O front end necessita da correta url da api para as requisicoes, em caso de erro do grupo codigo 500 alterar o arquivo: ./app/config/parametros.js

Hospedagem:
1. Copiar todo o conteudo do diretorio aplicação para a hospedagem, a aplicação funcionará nas versões do php 5.7 a 7.1. 
2. Caso a hospedagem for Linux condeceder permissao 777 ao diretorio: ./repositorio.

### Usage

Usuarios iniciais:

Admin@mail.com
professor@mail.com
aluno@mail.com

senha: 1234

### API

Request URL ./api/v1/

## License

#### (The MIT License)

Copyright (c) 2014 Bill Gooch

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
        distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

        The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

        THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
        EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
        IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
        TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.