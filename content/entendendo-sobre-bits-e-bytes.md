 ---

title: Entendo sobre bits e bytes e operadores logicos
author: leonardo
date: 2025-09-24
tags: ["Bits", "Bytes", "Computação"]
---

O episodio de CRC fizemos vários cálculos usando operadores lógicos e utilizando valores binários, ok, mas de onde vem o bit e oque são operadores lógicos ? Hoje vamos entender sobre o que são bits, bytes e operadores lógicos.  
Um processador é um microchip que realiza cálculos matemáticos para obter uma saída a partir de um determinado valor de entrada, dentro desses microchips temos milhões de componentes eletrônicos chamados transistores, não precisados necessariamente entender o que é esse componente, oque precisamos saber e que esse componente armazena um tipo de dado, que chamados de bit, quando o transistor esta desligado ele representa o valor 0, e quando esta ligado representa o valor 1, portando, um transistor só pode representar um valor por vez e justamente esse valor que chamamos de **bit**.  
Um bit e a menor unidade de armazenamento de dados, como logicamente só podemos representar dois valores, temos que usar uma base que não seja decimal, afinal não podemos representador qualquer valor acima de 1 em um componente que só representa 0 e 1, é ai que entra a **base binaria**, essa base usa apenas dois dígitos para representar qualquer valor em qualquer base, e adivinha? São justamente os valores 0 e 1, ok, e como representamos qualquer valor como apenas dois dígitos? Simples adicionamos mais dígitos da mesma base ou seja mais 0s e 1s.  
Tem um certo numero de possibilidades de valores que podemos representar a medida em que adicionamos mais bits, para calcular a possibilidade de números que podemos representar, basta elevarmos o valor 2 ao expoente que sera a quantidade de bits que temos para representar, acompanhe a tabela abaixo:  

| Bits | Cálculo | Possibilidades |
| :----: | :-------: | :--------------: |
| 1    | 2¹      | 2              |
| 2    | 2²      | 4              |
| 3    | 2³      | 8              |
| 4    | 2⁴      | 16             |
| 5    | 2⁵      | 32             |
| 6    | 2⁶      | 64             |
| 7    | 2⁷      | 128            |
| 8    | 2⁸      | 256            |

Perceba que agora temos uma forma para descobrir a quantidade de possibilidade de números que podemos representar com determinada quantidade de bits, N bits: \\(2^n\\) possibilidades. Na ultima linha desta tabela temos a um total de 8 bits que são capazes de representar até 256 possibilidades, neste ponto temos a definição de byte: *um **byte** um conjunto de 8 bits*. Um byte sempre sera terá 8 bits que vai de 00000000 a 11111111.  
A partir daqui temos agora outras ordens de grandeza, que são:

| Nomenclatura | Quantidade de Bytes |
| :-----------:| :-----------------: |
| 1 Byte       | 8 bits              |
| 1 KiloByte/KBytes | 1024 Bytes (2¹⁰) |
| 1 MegaByte/MByte  | 2²⁰ => 2¹⁰ * 2¹⁰ => 1024 KBytes |
| 1 GibaByte/GBytes | 2³⁰ Bytes => 1024 MBytes |
| 1 TeraByte/TBytes | 2⁴⁰ Bytes => 1024 GBytes |
| 1 PetaByte/PBytes | 2⁵⁰ Bytes => 1024 TBytes |

**Vimos que o valor de GBytes para TBytes por exemplo e de 1024 e em todas as outras grandezas e sempre 1024 da ordem de grandeza do valor anterior, pois bem, isso  acontece porque em binário o valor mais próximo que temos de 1000 e o valor 1024 ou seja 2¹⁰**  
Agora que já conhecemos o que são bits e bytes e suas ordens de grandeza, vamos falar de sistemas de numeração e conversão de bases, sabemos que a **base decimal** tem 10 dígitos de 0 a 9 e a **base binaria** tem 2 dígitos 0 e 1. Podemos através de cálculos matemáticos representar qualquer valor de um base em outra base e vice-versa.  
Para entendermos melhor o calculo, vamos reescrever o valor 3425 na base decimal usando notação cientifica:  

```
3425  
||||=> 5 * 10 ⁰  
|||=> 2 * 10¹  
||=> 4 * 10²  
|=> 3 * 10³  
```

Perceba um detalhe, os expoentes da direita para a esquerda o valor é crescente, lembre-se bem disso pois iremos usar este pequeno detalhe mais adiante.  
Que numero representa o byte 10100111 em base decimal ? Para descobrirmos vamos construir a mesma representação de notação cientifica para este valor, POREM na base binaria afinal o valor e binario.  

```
10100111  
||||||||=> 1 * 2⁰  
|||||||=> 1 * 2¹  
||||||=> 1 * 2²  
|||||=> 0 * 2³  
||||=> 0 * 2⁴  
|||=> 1 * 2⁵  
||=> 0 * 2⁶  
|=> 1 * 2⁷  
```

Agora vamos resolver essas pequenas equações e vamos somar tais resultados:

```
1 * 2⁰ = 1  
1 * 2¹ = 2
1 * 2² = 4  
0 * 2³ = 0  
0 * 2⁴ = 0  
1 * 2⁵ = 32  
0 * 2⁶ = 0  
1 * 2⁷ = 128  
```

Vamos somar os resultados: 1 + 2 + 4 + 0 + 0 + 32 + 0 + 128 = 167  
Sabemos agora que o byte 10100111 em binário representa o valor 167 em decimal, perceba que nessa conversão nos usamos primariamente a multiplicação.  
Agora na conversão de decimal para binario usaremos duas operações que é a divisão e o modulo, na divisão vamos aproveita o quociente e no modulo o resto da divisão, lembrando que para as duas operadores se convergirem e necessario que a divisão respeite o resto e não tente zera-la, afinal esse o principal fator de uso
do modulo (uma operação mod é uma divisão que não retorna o resultado em si, mas sim o resto daquela divisão),vamos converter o valor 37 para binário:  
  
37 mod 2 = 1 e Quociente e igual a 18  
18 mod 2 = 0 Quociente e igual a 9  
9 mod 2 = 1 Quociente e igual a 4  
4 mod 2 = 0 Quociente e igual a 2  
2 mod 2 = 0 Quociente e igual a 1  
1 mod 2 = 1 Quociente e igual a 0  
  
Perceba que, o resto de uma divisão é sempre menor que o dividendo portando vamos pegar somente os restos da divisão começando da ultima divisão feita, ate, a primeira divisão feita: 100101, vamos validar esse valor fazendo a conversão do binário para decimal:  

```
100101
|||||| => 1 * 2⁰
||||| => 0 * 2¹
|||| => 1 * 2²
||| => 0 * 2³
|| => 0 * 2⁴
| => 1 * 2⁵
```

Agora valor resolver as equações e soma-las:

```
1 * 2⁰ = 1
0 * 2¹ = 0
1 * 2² = 4
0 * 2³ = 0
0 * 2⁴ = 0
1 * 2⁵ = 32
```

Vamos somar os resultados: 1 + 0 + 4 + 0 + 0 + 32 = 37, perceba que o resultado final foi 37 novamente o que comprova que o nosso calculo de divisão está correto.
Portanto podemos transformar um valor decimal em binário apenas fazendo divisões consecutivas pelo base 2, e fazemos isso ate que o quociente da divisão seja 0.  
Como acabamos de ver, podemos facilmente converter a representação de valores entre diferentes bases numéricas, portanto vamos ver mais duas bases de extrema importância para a área tecnologia com um todo, a **base Octal** e a **base Hexadecimal**.  

## Base Octal  

A base octal trata-se de representações numéricas que vão de 0 a 7 (8 dígitos), a quantidade de bits que pode representar até 8 valores é 3 como vimos na primeira tabela.  
Vejamos brevemente como funciona as conversões de octal para decimal e vice versa e também para binário:  

### Decimal para Octal e vice-versa  

Para fazer a conversão de Decimal para Octal fazemos exatamente no formato do Decimal para Binário, divisões modulo sucessivas e pegamos o resto da ultima divisão ate a primeira e pronto, temos a representação do valor em Octal. Vamos representar o valor decimal 3259 em sua representação Octal:

3259 mod 8 = 3 o quociente é igual a 407  
407 mod 8 = 7 o quociente é igual a 50  
50 mod 8 = 2 o quociente é igual a 6  
6 mod 8 = 6 0 quociente é igual a 0  

Pegando o resto da ultima divisão ate a primeira sabemos que o valor 3259 Decimal é 6273 na base Octal.  
Agora Vejamos o inverso, da base Octal para a Base Decimal:

```
6273
||||=> 3 * 8⁰
|||=> 7 * 8¹
||=> 2 * 8²
|=> 6 * 8³
```

Resolvendo as equações e somando-as:

```
3 * 8⁰ = 3
7 * 8¹ = 56  
2 * 8² = 128
6 * 8³ = 3072
```

Vamos somar os resultados: 3 + 56 + 128 + 3072 = 3259, logo vemos que conseguimos voltar ao valor decimal original, o que prova que a equação está correta.

### Octal para binário e vice versa  

Para realizamos qualquer conversão de octal para binário ou binário para octal primeiro devemos converter o valor de octal para decimal e ai sim converter para binário no primeiro caso, no segundo devemos converter o binário para decimal e ai sim convertermos para octal. Mas em relação ao binario para octal, tem
uma forma bem mais eficaz de fazer essa conversão sem termos que intermediá-lo pelo decimal:
Vamos converter o valor Octal 1634 para binário:
Nessa conversão temos duas formas de fazer isso, a primeira e substituindo cada digito do valor octal pela sua representação em binario com 3 digitos, vejamos como
funciona.

```
1634: 
1 = 001 
6 = 110
3 = 011
4 = 100
```

Agora que sabemos o valor binario de cada digito do valor, valor concatena-los: 001110011100
Acho que agora deve está bem obvio como fam

## Base Hexadecimal

A base Hexadecimal e usada em muitos âmbitos da tecnologia, desde criptografias de valores até chaves de autenticação e tokens.  
A base Hexadecimal utiliza a base 16 (daí o nome obviamente), porem há uma peculiaridade que vamos ver agora: Os valores dessa base vão de 0 a 9 (Como na base decimal) porem quando chega em valores que dois digitos (10 ate o 15) em vez de usar os dígitos normalmente ele usa letras que vão de A (10) ate 15 (F), vejamos melhor nesta tabela:  

| Decimal | Hexadecimal |
| ------- | ----------- |
| 0 | 0 |
| 1 | 1 |
| 2 | 2 |
| 3 | 3 |
| 4 | 4 |
| 5 | 5 |
| 6 | 6 |
| 7 | 7 |
| 8 | 8 |
| 9 | 9 |
| 10 | A |
| 11 | B |
| 12 | C |
| 13 | D |
| 14 | E |
| 15 | F |
  
Por que isto acontece? Um digito no valor Decimal apenas 1 caractere, porem quando vamos representar valores acima de dois dígitos, passamos a ter que usar dois caracteres para mostrar esse valores, portanto para continuar usando apenas 1, mudamos a representação do valor em números por letra, as vantagens disso e que ocupam menos espaço em memoria, além de se tornarem visivelmente menores.  

### Conversões de numeros Hexadecimais  

As conversões de valores hexadecimais são na mesma logica dos valores Octais, onde para convertemos de binário para hexadecimal e vice versa precisamos intermediá-lo pela base decimal, então o valor binário vira decimal e depois sim hexadecimal e o mesmo e valido para o inverso.  
Vamos a alguns exemplos:  
Temos o byte  11001011 quero saber que valor ele representa em Hexadecimal, valor primeiro converte-lo pra decimal:  

```
11001011
||||||||=> 1 * 2⁰
|||||||=> 1 * 2¹
||||||=> 0 * 2²
|||||=> 1 * 2³
||||=> 0 * 2⁴
|||=> 0 * 2⁵
||> 1 * 2⁶
|=> 1 * 2⁷
```

Temos agora o valor em decimal:  

```
1 * 2⁰ = 1 
1 * 2¹ = 2
0 * 2² = 0
1 * 2³ = 8
0 * 2⁴ = 0
0 * 2⁵ = 0
1 * 2⁶ = 64
1 * 2⁷ = 128
```

Somando os valores:  
1 + 2 + 0 + 8 + 0 + 0 + 64 + 128 = 203  
