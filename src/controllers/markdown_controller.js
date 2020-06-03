import { Controller } from "stimulus";

export default class extends Controller {
  static targets = [ "content", "output" ]

  render_markdown() {
    const md = require('markdown-it')({
      breaks: true,
    });
    const result = md.render(this.content);

    this.outputTarget.innerHTML = result;
  }

  get content() {
    return this.contentTarget.value;
  }
}
