# thorr-advent
[Advent of Code](http://adventofcode.com/) puzzle solutions wrapped in a PHP7 CLI app.
Most overkill and far from code golf as it can be.

## Installation

### Composer global install

```shell
$: composer global require stefanotorresi/thorr-advent
```

The executable will be `~/.composer/bin/advent`.

### Git

```shell
$: git clone https://github.com/stefanotorresi/thorr-advent
$: cd thorr-advent
$: composer install
```

The executable will be `./advent`.

### Phar
`TBD`

## Usage

Each puzzle is available as a command named `dayN`.

You can use either a file path or stdin as input:  
```shell
$: advent day1 day1.txt
```

```shell
$: echo "()()())))((((((((((((" | advent day1
```

Both parts of the puzzle will be executed by default, but you can execute just a single part if you want, 
using the `--part` option:
```shell
$: advent day1 day1.txt --part basement
```

You can get to know the part names with the `help` command:
```shell
$: advent help day1
```
