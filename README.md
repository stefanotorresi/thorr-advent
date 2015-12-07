# thorr-advent
[Advent of Code](http://adventofcode.com/) puzzle solutions wrapped in a PHP7 CLI app

## Installation

Via Composer global install

```shell
$: composer require global stefanotorresi/thorr-advent
```

Via Git

```shell
$: git clone https://github.com/stefanotorresi/thorr-advent
$: cd thorr-advent
$: composer install
```

Via phar binary
`TBD`

## Usage exampe

```shell
$: echo "()()())))((((((((((((" | ./advent day1
Santa is at floor 9
Santa entered the basement after stepping into 7 floors
```
You can also use an input file as argument and/or specify just one part of the daily puzzle

```shell
$: ./advent day5 day5.txt -p strings 
There are 236 nice strings in there
```


