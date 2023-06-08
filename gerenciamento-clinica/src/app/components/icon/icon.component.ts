import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-icon',
  templateUrl: './icon.component.html',
  styleUrls: ['./icon.component.scss']
})
export class IconComponent implements OnInit {

  @Input() icon?: string;
  @Input() height: number = 60;
  @Input() width: number = 60;
  public path: string = "assets/icons";
  constructor() { }

  ngOnInit(): void {
  }

}
