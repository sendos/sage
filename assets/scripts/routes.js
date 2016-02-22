'use strict'

export default function routes (match) {
  match('', 'sage#home')
  match(':id', 'sage#post')
}