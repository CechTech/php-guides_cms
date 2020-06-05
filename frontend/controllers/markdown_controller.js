import { Controller } from "stimulus";

export default class extends Controller {
  static targets = [ "content", "output" ]

  connect() {
    this.result
  }

  render_markdown() {
    this.result
  }

  get content() {
    return this.contentTarget.value;
  }

  get md() {
    const md = require('markdown-it')({
      breaks: true,
    }).use(require('markdown-it-textual-uml'));

    const mermaid = require('mermaid');
    mermaid.initialize({
      theme: 'forest'
    });

    return md;
  }

  get result() {
    const result = this.md.render(this.content);

    this.outputTarget.innerHTML = result;
  }
}
