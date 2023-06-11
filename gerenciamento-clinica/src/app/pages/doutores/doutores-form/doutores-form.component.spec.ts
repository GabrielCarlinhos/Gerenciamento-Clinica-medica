import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DoutoresFormComponent } from './doutores-form.component';

describe('DoutoresFormComponent', () => {
  let component: DoutoresFormComponent;
  let fixture: ComponentFixture<DoutoresFormComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [DoutoresFormComponent]
    });
    fixture = TestBed.createComponent(DoutoresFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
